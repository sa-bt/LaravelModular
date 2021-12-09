<?php
return [
    "MediaTypeService" => [
        "image" => [
            "extensions" => [
                "png", "jpg", "jpeg"
            ],
            "handler"    => \Sabt\Media\Services\ImageFileService::class,
            "direction"  => "public\\"
        ],
        "video" => [
            "extensions" => [
                "avi", "mkv", "mp4"
            ],
            "handler"    => \Sabt\Media\Services\VideoFileService::class,
            "direction"  => "private\\"
        ],
        "zip"   => [
            "extensions" => [
                "zip", "rar", "tar"
            ],
            "handler"    => \Sabt\Media\Services\ZipFileService::class,
            "direction"  => "private\\"
        ]
    ]
];
