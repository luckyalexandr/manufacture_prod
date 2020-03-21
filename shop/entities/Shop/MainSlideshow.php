<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.01.19
 * Time: 5:19
 */

namespace shop\entities\Shop;


use shop\forms\manage\Shop\MainSlideshowForm;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * Class MainSlideshow
 * @package shop\entities\Shop
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $image
 * @property string $link
 * @property integer $sort
 */
class MainSlideshow extends ActiveRecord
{
    public static function create($title, $text, $link, $sort, UploadedFile $image): self
    {
        $slideShow = new MainSlideshow();
        $slideShow->title = $title;
        $slideShow->text = $text;
        $slideShow->link = $link;
        $slideShow->sort = $sort;
        $slideShow->image = $image;
        return $slideShow;
    }

    public function edit($title, $text, $link, $sort): void
    {
        $this->title = $title;
        $this->text = $text;
        $this->link = $link;
        $this->sort = $sort;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public static function tableName(): string
    {
        return '{{%shop_main_banner}}';
    }

    public function attributeLabels(): array
    {
        return [
            'title' => 'Наименование',
            'text' => 'Текст',
            'image' => 'Изображение',
            'link' => 'Ссылка',
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@webroot/origin/mainSlideShow/[[id]].[[extension]]',
                'fileUrl' => '@web/origin/mainSlideShow/[[id]].[[extension]]',
                'thumbPath' => '@webroot/cache/mainSlideShow/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@web/cache/mainSlideShow/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'small' => ['width' => 100, 'height' => 70],
                    'main' => ['width' => 1920, 'height' => 560]
                ],
            ],
        ];
    }
}