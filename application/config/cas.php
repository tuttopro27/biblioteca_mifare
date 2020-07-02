<?php
//Constantes configuración CAS
define('CAS_SERVER', 'sso-lib.uc.cl');
define('CAS_PORT', 443);
define('CAS_URI', "/cas");
define('CAS_PRELOGIN', "https://".CAS_SERVER."/cas/login");
define('CAS_PRELOGOUT', "https://".CAS_SERVER."/cas/logout");
define('CAS_TIEMPO', 1200);
define('CAS_NoCasServerValidation', true);
define('CAS_LOG', '/ariadna/www13/cgi-bin/gestion_saf/CAS_LOG.cas');
define('PHPCAS_CERT_LIB', '');


//Constantes configuración LDAP
define('LDAP_SERVER', 'ds-des.uc.cl');
define('DN', 'o=puc,c=cl');
?>