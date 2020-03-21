<?php
namespace frontend\components;
 
use common\models\Page;
use yii\web\UrlRuleInterface;
use yii\base\Object;
 
class PageRule implements UrlRuleInterface {
    public function createUrl($manager, $route, $params)
    {
        if ($route !== 'page/index' || isset($params['id']) === false) { // проверяем, что это маршрут для страницы и нам передали id-записи
        return false; // return false сообщает UrlManager-у, что мы не смогли построить url и необходимо попробовать применить следующее правило
        }
        $slug = Page::find() // тут все просто. Это поиск записи в БД.
            ->select('url')
            ->where(
                [
                    'id' => $params['id'],
                ]
            )
            ->scalar();
        if ($slug !== false) { // если поиск увенчался успехом, то неободимо вернуть найденный урл
            return '/' . $slug; // слеш в начале дает знать, что это абсолютный url
        }
        return false; // мы ничего не нашли в БД :(
    }

    public function parseRequest($manager, $request)
    {
        $url = trim($request->pathInfo, '/'); // удаляем слеши из начала и конца url
        $page = Page::find() // ищем запись по url
        ->where(
            [
                'url' => $url,
            ]
        )
        ->one();
        if ($page !== null) { // если нашли, то передаем данные в PageController::actionShow($id). В нем будем рендерить страницу
            return ['page/index', ['id' => $page->id]];
        }
        return false; // сообщаем UrlManager, что ничего не нащли и необходимо попробовать применит следующее правило

    }
}