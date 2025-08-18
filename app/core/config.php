<?php
    if ($_SERVER['HTTP_HOST'] === 'dev.areafriki.com') {
        //Muestra de errores en hosting, solo para debug
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        define("DEBUG", true);

        //INFO-----------------------------------------------------
        define("PAGE_NAME", "Área Friki");
        define("DIR", dirname(dirname( __DIR__ )));
        define("PAGE_DOMAIN", "https://dev.areafriki.com");
        define("BLOG_DOMAIN", "https://areafriki.com/space");
        define("BLOG_PATH", DIR.'/../areafriki/space');
        $data['page_title'] = PAGE_NAME;

        //Server information----------------------------------------
        define("DATABASE_USER", "areafriki");
        define("DATABASE_PASS", "Are4fr1k1");
        define("DATABASE_NAME", "lafrikitienda");
        define("DATABASE_SERVER", "localhost");

        //pago information
        define("USE_SANDBOX",true);
        define("PAYPAL","central-facilitator@areafriki.com");
        define("IBAN", "CUENTA DE MENTIRA");
        define("STRIPE_PUBLIC", false);
        define("STRIPE_SECRET", false);

        //MAINTENANCE
        define("MAINTENANCE",false);
    } elseif ($_SERVER['HTTP_HOST'] === 'areafriki.com') {
        //Muestra de errores en hosting, solo para debug
        error_reporting(E_ALL);
        ini_set('display_errors', false);
        define("DEBUG", false);

        //INFO-----------------------------------------------------
        define("PAGE_NAME", "Área Friki");
        define("DIR", dirname(dirname( __DIR__ )));
        define("PAGE_DOMAIN", "https://areafriki.com");
        define("BLOG_DOMAIN", "https://areafriki.com/space");
        define("BLOG_PATH", DIR.'/space');
        $data['page_title'] = PAGE_NAME;

        //Server information----------------------------------------
        define("DATABASE_USER", "areafriki");
        define("DATABASE_PASS", "Are4fr1k1");
        define("DATABASE_NAME", "areafriki");
        define("DATABASE_SERVER", "localhost");

        //pago information
        define("USE_SANDBOX",false);
        define("PAYPAL","central@areafriki.com");
        define("IBAN", false);
        define("STRIPE_PUBLIC", false);
        define("STRIPE_SECRET", false);

        //ANALYTICS
        define("GOOGLE_ANALYTICS", false);
        define("HOTJAR", false);

        //MAINTENANCE
        define("MAINTENANCE", false);
    }

    //email information------------------------------------------
    define("CONTACT_EMAIL", "central@areafriki.com");
    define("NOREPLY_EMAIL", "noreply@areafriki.com");
    define("ERROR_EMAIL", "error@areafriki.com");
    define("ADMIN_EMAIL", "admin@areafriki.com");
    define("SUPPORT_EMAIL", "support@areafriki.com");

    define("SMTP_HOST", "smtp.1and1.es");
    define("SMTP_PORT", "465");
    define("SMTP_SECURE", "ssl");
    define("SMTP_PASS", false);
    define("SMTP_EMAIL", NOREPLY_EMAIL);

    //TOKEN------------------------------------------------------
    define("GLOBAL_TOKEN", "fr1k1W1k1");
    define("EMAIL_TOKEN", "InMyF4c3");

    //PAGE RULES
    define("GASTOS_ENVIO", 3.50);//euros
    define("MIN_ENVIO_GRATIS", 25.00);//euros
    define("TIEMPO_ENVIO", 2);//dias
    define("PREPARACION", 3);//dias
    define("TIEMPO_ESPERA", 18);//horas
    define("COMISION_REFERER", 3); //3% comision si traen a un comprador

    //Configuración local
    setlocale(LC_TIME, "es_ES");

    //TimeZone
    define("TIMEZONE", 'Europe/Madrid');
    putenv("TZ=".TIMEZONE);
    date_default_timezone_set(TIMEZONE);
    ini_set('date.timezone', TIMEZONE);
