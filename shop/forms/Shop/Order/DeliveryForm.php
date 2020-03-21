<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 4:44
 */

namespace shop\forms\Shop\Order;

use LisDev\Delivery\NovaPoshtaApi2;
use shop\entities\Shop\DeliveryMethod;
use shop\helpers\PriceHelper;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DeliveryForm extends Model
{
    public $np;
    public $method;
    public $address;
    public $area;
    public $city;
    public $warehouse;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['method'], 'integer'],
            [['address', 'warehouse'], 'required',
                'when' => function () {
                    if (!$this->address && !$this->warehouse) {
                        $this->addError('address', 'Необходимо указать либо адрес, либо отделение "Новой Почты".');
                        $this->addError('warehouse', 'Необходимо указать либо адрес, либо отделение "Новой Почты".');
                    }
                },
                'whenClient' => 'function (attribute, value) { return !$(\'#order-phone\').val().length && !$(\'#order-email\').val().length ;}',
                'message' => 'Необходимо указать либо телефон, либо email.',
            ],
            [['address', 'warehouse', 'city', 'area'], 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'created_at' => 'Дата создания',
            'status' => 'Статус',
            'current_status' => 'Текущий статус заказа',
            'delivery_method_name' => 'Метод доставки',
            'address' => 'Адрес доставки',
            'area' => 'Область',
            'city' => 'Город',
            'warehouse' => 'Отделение',
            'cost' => 'Стоимость',
            'note' => 'Примечание'
        ];
    }

    public function deliveryMethodsList(): array
    {
        $methods = DeliveryMethod::find()->orderBy('sort')->all();

        return ArrayHelper::map($methods, 'id', function (DeliveryMethod $method) {
            return $method->name/* . ' (' . PriceHelper::format($method->cost) . ')'*/;
        });
    }

    public function getNp()
    {
        $np = new NovaPoshtaApi2(
            '91a670da73ca78be05a661578766a6f6',
            'ru'
        );
        return $np;
    }

    public function getArea($i)
    {
        if($i != null) {
            $area = self::getNp()->getAreas()['data'][$i]['Description'];
        } else {
            $area = null;
        }
        return $area;
    }

    public function getAreas()
    {
        $areas = $this->getNp()->getAreas()['data'];
        $tareas = [];
        $i = 0;
        foreach ($areas as $area) {
            $tareas[$i] = [
                'Ref' => $area['Ref'],
                'Description' => \Yii::t('areas', $area['Description']),
            ];
            $i++;
        }
        return $tareas;
    }

    public function getCities()
    {
        $cities = $this->getNp()->getCities()['data'];
        return $cities;
    }

    public function getCityName($i)
    {
        foreach (self::getNp()->getCities()['data'] as $city) {
            if ($city['Ref'] == $i) {
                return $city['DescriptionRu'];
            }
        }
    }

    public function getWarehouses($city)
    {
        if (!isset($city)) {
            $warehouses = $this->getNp()->getWarehouses($this->getCities()[$city]['Ref']);
        }
        return ;
    }
}