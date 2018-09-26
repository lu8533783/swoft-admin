<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/25
 * Time: 14:17
 */

namespace App\Utils;

use Swoft\Http\Message\Upload\UploadedFile;
use OSS\OssClient;

class UploadFile
{

    /**
     * @param $file
     * @return string
     * @throws \OSS\Core\OssException
     */
    public static function upload($file)
    {
        /* @var UploadedFile $file */
        $file = $file->toArray();
        $extend = pathinfo($file['name']);
        $accessKeyId = config('oss.id');
        $accessKeySecret = config('oss.secret');
        $endpoint = config('oss.endpoint');
        $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
        $bucket = config('oss.bucket');
        $object = date('Y-m') . '/' . md5(uniqid() . mt_rand(1, 9999)) . '.' . $extend['extension'];
        $content = $file['tmp_file']; // Content of the uploaded file
        $ossClient->uploadFile($bucket, $object, $content);
        unlink($file['tmp_file']);
        return $object;
    }

}