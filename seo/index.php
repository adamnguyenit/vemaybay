<?php

function generateFacebookGraph($url, $title, $description, $images)
{
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    echo '<html xmlns="http://www.w3.org/1999/xhtml" lang="vi" xml:lang="vi">';
    echo '<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# vemaybayhaiphiyen: http://ogp.me/ns/fb/vemaybayhaiphiyen#">';
    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
    echo '<meta property="fb:app_id" content="1720543934884790">';
    echo '<meta property="og:type" content="vemaybayhaiphiyen:website">';
    echo '<meta property="og:url" content="http://seo.vemaybayhaiphiyen.com' . $url . '">';
    echo '<meta property="og:site_name" content="Vé máy bay Hải Phi Yến">';
    echo '<meta property="og:locale" content="vi_VN">';
    echo '<meta property="og:title" content="' . $title . '">';
    echo '<meta property="og:description" content="' . $description . '">';
    foreach ($images as $image) {
        echo '<meta property="og:image" content="' . $image . '">';
    }
    echo '<link rel="origin" href="http://vemaybayhaiphiyen.com' . $url . '">';
    echo '<title>' . $title . '</title>';
    echo '</head>';
    echo '<body>';
    echo '<h1>' . $title . '</h1>';
    echo '<p>' . $description . '</p>';
    foreach ($images as $image) {
        echo '<img src="' . $image . '">';
    }
    echo '</body>';
    echo '</html>';
}

function getJson($type, $alias, $fields = [])
{
    $url = "http://api.vemaybayhaiphiyen.com/app/$type/$alias";
    if (!empty($fields)) {
        $url .= '?fields=' . implode(',', $fields);
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
}

function base64ToImage($base64Str)
{
    $mimeToExt = [
        'data:image/gif;base64' => '.gif',
        'data:image/jpeg;base64' => '.jpg',
        'data:image/png;base64' => '.png',
    ];
    $filename = md5($base64Str);
    $data = explode(',', $base64Str);
    $imgData = base64_decode($data[1]);
    if (!empty($mimeToExt[$data[0]])) {
        $filename .= $mimeToExt[$data[0]];
    }
    $ifp = fopen($filename, 'wb');
    fwrite($ifp, $imgData);
    fclose($ifp);
    return $filename;
}

$url = $_SERVER['REQUEST_URI'];
$title = 'Vé máy bay Hải Phi Yến';
$description = 'Vé máy bay Hải Phi Yến cung cấp dịch vụ đặt mua vé máy bay trong nước và quốc tế giá rẻ nhất';
$images = ['http://seo.vemaybayhaiphiyen.com/logo.jpg'];
if (!empty($url)) {
    $urlArr = explode('/', $url);
    if (empty($urlArr[0])) {
        unset($urlArr[0]);
    }
    $urlArr = array_values($urlArr);
    switch ($urlArr[0]) {
        case 'khuyen-mai.html':
            $title = 'Khuyến mãi - Vé máy bay Hải Phi Yến';
            $description = 'Vé máy bay Hải Phi Yến hiện đang có rất nhiều khuyến mãi hấp dẫn. Click ngay!';
        break;
        case 'tin-tuc.html':
            $title = 'Tin tức - Vé máy bay Hải Phi Yến';
            $description = 'Vé máy bay Hải Phi Yến luôn cập nhật những thông tin nóng hổi trong nước cũng như trên toàn thế giới';
        break;
        case 'tin-tuc':
            $alias = substr($urlArr[1], 0, strlen($urlArr[1]) - 5);
            $json = getJson('news', $alias, ['title', 'description', 'images']);
            $title = $json['title'];
            $description = preg_replace('/\s+/', ' ', $json['description']);
            foreach ($json['images'] as $image) {
                if (strpos($image, 'base64') !== false) {
                    $image = 'http://seo.vemaybayhaiphiyen.com/' . base64ToImage($image);
                }
                $images[] = $image;
            }
        break;
        case 'khuyen-mai':
            $alias = substr($urlArr[1], 0, strlen($urlArr[1]) - 5);
            $json = getJson('promotion-news', $alias, ['title', 'description', 'images']);
            $title = $json['title'];
            $description = preg_replace('/\s+/', ' ', $json['description']);
            foreach ($json['images'] as $image) {
                if (strpos($image, 'base64') !== false) {
                    $image = 'http://seo.vemaybayhaiphiyen.com/' . base64ToImage($image);
                }
                $images[] = $image;
            }
        break;
    }
}
generateFacebookGraph($url, $title, $description, $images);
