<?php
$cache = Bitrix\Main\Data\Cache::createInstance(); // Служба кеширования

$cachePath = 'ion_config'; // папка, в которой лежит кеш
$cacheTtl = 3600; // срок годности кеша (в секундах)
$cacheKey = 'ion_config_general'; // имя кеша

if ($cache->initCache($cacheTtl, $cacheKey, $cachePath))
{
    $GLOBALS['ion'] = $cache->getVars(); // Получаем переменные
    $cache->output(); // Выводим HTML пользователю в браузер
}
elseif ($cache->startDataCache())
{
    if (CModule::IncludeModule('ion')) {
        $GLOBALS['ion'] = [
            'phone' => Ion\Settings::getSpaceField("UF_PHONE", "MAIN"),
            'email' => Ion\Settings::getSpaceField("UF_MAIL", "MAIN"),
            'telegramm_bot' => Ion\Settings::getSpaceField("UF_TELEGRAM", "MAIN"),
            'telegramm' => Ion\Settings::getSpaceField("UF_TELEGRAM2", "MAIN"),
            'djen' => Ion\Settings::getSpaceField("UF_DJEN", "MAIN"),
            'behance' => Ion\Settings::getSpaceField("UF_BEHANCE", "MAIN"),
            'instagram' => Ion\Settings::getSpaceField("UF_INSTAGRAM", "MAIN"),
            'youtube' => Ion\Settings::getSpaceField("UF_YOUTUBE", "MAIN"),
            'code_before_head_close' => Ion\Settings::getSpaceField("UF_CODE_BEFORE_HEAD_CLOSE", "MAIN"),
            'code_before_body_close' => Ion\Settings::getSpaceField("UF_CODE_BEFORE_BODY_CLOSE", "MAIN"),
            'founder_photo' => CFile::GetPath(Ion\Settings::getSpaceField("UF_FOUNDER_PHOTO", "MAIN")),
            'presentation' => CFile::GetPath(Ion\Settings::getSpaceField("UF_PRESENTATION", "MAIN")),
            'closed_projects' => Ion\Settings::getSpaceField("UF_CLOSED_PROJECTS", "MAIN"),
            'experience' => Ion\Settings::getSpaceField("UF_EXPERIENCE", "MAIN"),
            'countres' => Ion\Settings::getSpaceField("UF_COUNTRES", "MAIN"),
            'projects_leed' => Ion\Settings::getSpaceField("UF_PROJECTS_LEED", "MAIN"),
            'founder_education' => Ion\Settings::getSpaceField("UF_FOUNDER_EDUCATION", "MAIN"),
            'founder_adwards' => Ion\Settings::getSpaceField("UF_FOUNDER_ADVARDS", "MAIN"),
            'founder_work_time' => Ion\Settings::getSpaceField("UF_WORK_TIME", "MAIN"),
            'home_video_youtube_modal' => Ion\Settings::getSpaceField("UF_YOUTUBE_VIDEO_LINK", "MAIN"),
            'course_price' => Ion\Settings::getSpaceField("UF_COURSE_PRICE", "MAIN"),
            'course_advantages' => Ion\Settings::getSpaceField("UF_COURSE_ADVANTAGES", "MAIN"),
            'course_module' => Ion\Settings::getSpaceField("UF_COURSE_MODULE", "MAIN"),
            'course_video_count' => Ion\Settings::getSpaceField("UF_COURSE_VIDEO_COUNT", "MAIN"),
            'course_phone_calls' => Ion\Settings::getSpaceField("UF_COURSE_PHONE_CALLS", "MAIN"),
            'course_back_relation' => Ion\Settings::getSpaceField("UF_COURSE_BACK_RELATION", "MAIN"),

        ];
    }

//    echo '<b>Какие-то данные выводятся пользователю (Если кеш не работает, то это число будет меняться: '.rand(0, 9999).')</b>';

    // Если что-то пошло не так и решили кеш не записывать
    $cacheInvalid = false;
    if ($cacheInvalid)
    {
        $cache->abortDataCache();
    }

    // Всё хорошо, записываем кеш
    $cache->endDataCache($GLOBALS['ion']);
}


unset($cache,$cachePath,$cacheTtl,$cacheKey,$cacheInvalid);

// Данные будут обновляться раз в час
//    dump($GLOBALS['ion']);