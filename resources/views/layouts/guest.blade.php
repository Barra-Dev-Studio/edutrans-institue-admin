<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Edutrans Institute</title>
        <meta name="title" content="Edutrans Institute" />
        <meta name="description"
            content="EDUTRANS.ID adalah lembaga training yang bertujuan untuk mengoptimasi proses pendidikan yang bermutu untuk menciptakan transformasi positif dalam kehidupan individu, organisasi, dan lembaga. Pendiri EDUTRANS.ID Dr. Hendi Pratama, percaya bahwa optimalisasi pendidikan merupakan kunci peningkatan produktivitas dan kesejahteraan." />

        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://edutransinstitute.com" />
        <meta property="og:title" content="Edutrans Institute" />
        <meta property="og:description"
            content="EDUTRANS.ID adalah lembaga training yang bertujuan untuk mengoptimasi proses pendidikan yang bermutu untuk menciptakan transformasi positif dalam kehidupan individu, organisasi, dan lembaga. Pendiri EDUTRANS.ID Dr. Hendi Pratama, percaya bahwa optimalisasi pendidikan merupakan kunci peningkatan produktivitas dan kesejahteraan." />
        <meta property="og:image" content="https://edutransinstitute.com/assets/images/og.png" />

        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="https://edutransinstitute.com" />
        <meta property="twitter:title" content="Edutrans Institute" />
        <meta property="twitter:description"
            content="EDUTRANS.ID adalah lembaga training yang bertujuan untuk mengoptimasi proses pendidikan yang bermutu untuk menciptakan transformasi positif dalam kehidupan individu, organisasi, dan lembaga. Pendiri EDUTRANS.ID Dr. Hendi Pratama, percaya bahwa optimalisasi pendidikan merupakan kunci peningkatan produktivitas dan kesejahteraan." />
        <meta property="twitter:image" content="https://edutransinstitute.com/assets/images/og.png" />
        
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/icons.css'])
    </head>
    <body data-mode="light" data-sidebar-size="lg">
        {{ $slot }}
    </body>
</html>
