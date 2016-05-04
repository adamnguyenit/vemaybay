<?php

namespace app\models;

use yii\helpers\StringHelper;

class News extends \yii\db\ActiveRecord
{
    public function fields()
    {
        return [
            'id',
            'alias',
            'title',
            'content',
            'image',
            'images',
            'description',
            'createdAt'
        ];
    }

    public function getDescription()
    {
        return empty($this->content) ? null : StringHelper::truncateWords(strip_tags($this->content), 50);
    }

    public function getImages()
    {
        $document = new \DOMDocument();
        if (!empty($this->content)) {
            $internalErrors = libxml_use_internal_errors(true);
            $document->loadHTML($this->content);
            libxml_use_internal_errors($internalErrors);
        } else {
            return [];
        }
        $images = [];

        foreach ($document->getElementsByTagName('img') as $img) {
            $image = $img->getAttribute('src');
            if (empty($image)) {
                continue;
            }
            $images[] = $image;
        }

        return $images;
    }

    public function getImage()
    {
        $images = $this->images;
        if (!empty($images)) {
            return $images[0];
        }

        return;
    }

    public function getCreatedAt()
    {
        $titles = [
            'Mon' => 'Thứ 2',
            'Tue' => 'Thứ 3',
            'Wed' => 'Thứ 4',
            'Thu' => 'Thứ 5',
            'Fri' => 'Thứ 6',
            'Sat' => 'Thứ 7',
            'Sun' => 'CN',
        ];
        return empty($this->created_at) ? null : $titles[date('D', $this->created_at)] . ', ngày ' . date('d/m/Y', $this->created_at);
    }
}
