<?php
class BaseFunctions
{
    public $version = "f2e";
    protected $db_connection = NULL;

    public $ID = NULL;
    public $username = "";
    protected $password = "";
    public $token_rememberme = "";
    public $admin_status = NULL;
    public $firstname_user = "";
    public $lastname_user = "";
    public $email_user = "";
    public $tel_user = "";
    public $status = NULL;
    public $created_time = "";
    public $token_validare_email = "";
    public $acc_nl = "";
    public $acc_nl_time = "";
    public $delete_time = "";

    protected $errflag = false;

    public $user_is_logged_in = false;
    public $redirect = "";
    public $view = "f_index";
    public $lang = "ro";

    public $now = "";

    public $extensions = array(
        'img'=>array('bmp', 'gif', 'ico', 'iff', 'jpc', 'jp2', 'jpx', 'jb2', 'jpg', 'jpeg', 'png', 'psd', 'swc', 'swf', 'tiff', 'tiff', 'wbmp', 'webp', 'xbm', 'xpm'),
        'pdf'=>array('pdf'), 
        'img_pdf'=>array('bmp', 'gif', 'ico', 'iff', 'jpc', 'jp2', 'jpx', 'jb2', 'jpg', 'jpeg', 'png', 'psd', 'swc', 'swf', 'tiff', 'tiff', 'wbmp', 'webp', 'xbm', 'xpm', 'pdf'), 
        'vid'=>array( 'avi','mp3', 'mp4', 'mpeg', 'm4v', 'mov', 'qt'), 
        'doc'=>array('doc', 'docx'),
        'docs'=>array('pdf','doc', 'docx')
    );
    public $types = array(
        'img'=>array('image/bmp', 'image/gif', 'image/ico', 'image/iff', 'image/jpc', 'image/jp2', 'image/jpx', 'image/jb2', 'image/jpg', 'image/jpeg', 'image/png', 'image/psd', 'image/swc', 'image/swf', 'image/tiff', 'image/tiff', 'image/wbmp', 'image/webp', 'image/xbm', 'image/xpm'),
        'pdf'=>array('application/pdf'), 
        'img_pdf'=>array('image/bmp', 'image/gif', 'image/ico', 'image/iff', 'image/jpc', 'image/jp2', 'image/jpx', 'image/jb2', 'image/jpg', 'image/jpeg', 'image/png', 'image/psd', 'image/swc', 'image/swf', 'image/tiff', 'image/tiff', 'image/wbmp', 'image/webp', 'image/xbm', 'image/xpm', 'application/pdf'), 
        'vid'=>array('video/x-msvideo', 'audio/mpeg', 'video/mp4', 'video/mpeg', 'video/x-m4v', 'video/quicktime', 'video/quicktime'), 
        'doc'=>array('application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
        'docs'=>array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
    );



    public $rep = array();


    public $translate = array();


    public $page = 1;
    public $pager = "";

    public $tinyMce = false;
    public $lightbox = false;
    public $imageLoader = false;
    public $slimCrop = false;
    public $pageSel2 = false;
    public $dataTable = false;
    public $fileUploader = false;

    public $page_title = "Two & From - CMS";
    public $page_description = "Atinge întregul potențial al organzației tale";
    public $page_url = BASE_URL;
    public $page_image = "";

    public function __construct(){

        $this->now = date("Y-m-d H:i:s");

        if (isset($_GET['view'])) {
            $this->view=$_GET['view'];
        }
        if (isset($_GET['lang'])) {
            $this->lang=$_GET['lang'];
        }

        $this->translate['b_acc_login']['link_label']['ro'] = 'Login';
        $this->translate['b_acc_login']['link_label']['en'] = 'Login';
        
        $this->translate['b_acc_logout']['link_label']['ro'] = 'Logout';
        $this->translate['b_acc_logout']['link_label']['en'] = 'Logout';
        
        $this->translate['b_acc_general']['link_label']['ro'] = 'Contul meu';
        $this->translate['b_acc_general']['link_label']['en'] = 'My account';
        
        $this->translate['b_acc_security']['link_label']['ro'] = 'Setări de siguranță';
        $this->translate['b_acc_security']['link_label']['en'] = 'Security settings';
        
        $this->translate['b_acc_communication']['link_label']['ro'] = 'Newsletter';
        $this->translate['b_acc_communication']['link_label']['en'] = 'Newsletter';
        
        $this->translate['b_acc_delete_info']['link_label']['ro'] = 'Ștergere cont';
        $this->translate['b_acc_delete_info']['link_label']['en'] = 'Delete account';
        
        $this->translate['b_acc_delete_confirm']['link_label']['ro'] = 'Ștergere cont';
        $this->translate['b_acc_delete_confirm']['link_label']['en'] = 'Delete account';




        $this->translate['f_index']['link_label']['ro'] = 'Acasă';
        $this->translate['f_index']['link_label']['en'] = 'Home';

        $this->translate['f_about']['link_label']['ro'] = 'Despre';
        $this->translate['f_about']['link_label']['en'] = 'About';

        $this->translate['f_services']['link_label']['ro'] = 'Servicii';
        $this->translate['f_services']['link_label']['en'] = 'Services';

        $this->translate['f_contact']['link_label']['ro'] = 'Contactează-ne';
        $this->translate['f_contact']['link_label']['en'] = 'Contact us';

        $this->translate['f_policy_tc']['link_label']['ro'] = 'Termene și condiții';
        $this->translate['f_policy_tc']['link_label']['en'] = 'Terms and Conditions';

        $this->translate['f_policy_cf']['link_label']['ro'] = 'Politica de confindețialitate';
        $this->translate['f_policy_cf']['link_label']['en'] = 'Confidentiality policy';

        $this->translate['f_policy_ck']['link_label']['ro'] = 'Politica de cookies';
        $this->translate['f_policy_ck']['link_label']['en'] = 'Cookies policy';

        if ($this->view=='b_acc_logout') {

            $args = array();
            $args['id_user'] = $this->ID;
            $args['target_table'] = "users";
            $args['id_target'] = $this->ID;
            $args['note'] = "User &ldquo;".$this->username."&rdquo; logged out. (base)";
            $this->logAction($args);

            $this->doLogout();
            $this->redirect = $this->buildUrl(array('view'=>"f_index"));
        }elseif (isset($_COOKIE['rememberme'])) {

            $this->loginWithCookieData();
        }elseif (isset($_SESSION['id_user'])&&!empty($_SESSION['id_user'])&&$_SESSION['loggedin']==true) {

            $this->loginWithSessionData();
        }

        if (isset($_POST['register'])) {

            $args = array();

            if (isset($_POST['register-email'])) {
                $args['email'] = trim(htmlspecialchars(strtolower($_POST['register-email'])));
            }else{
                $args['email'] = "";
            }

            if (isset($_POST['register-tel'])) {
                $args['tel'] = trim(htmlspecialchars(strtolower(preg_replace("/[^0-9]/", "", $_POST['register-tel']))));
            }else{
                $args['tel'] = "";
            }
            if (isset($_POST['register-username'])) {
                $args['username'] = trim(htmlspecialchars($_POST['register-username']));
            }else{
                $args['username'] = "";
            }
            if (isset($_POST['register-password'])) {
                $args['password'] = trim(htmlspecialchars($_POST['register-password']));
            }else{
                $args['password'] = "";
            }



            if (isset($_POST['register-firstname'])) {
                $args['firstname'] = trim(htmlspecialchars($_POST['register-firstname']));
            }else{
                $args['firstname'] = "";
            }
            if (isset($_POST['register-lastname'])) {
                $args['lastname'] = trim(htmlspecialchars($_POST['register-lastname']));
            }else{
                $args['lastname'] = "";
            }

            if (isset($_POST['register-acc_tc'])) {
                $args['acc_tc'] = trim(htmlspecialchars($_POST['register-acc_tc']));
            }else{
                $args['acc_tc'] = "";
            }
            if (isset($_POST['register-acc_nl'])) {
                $args['acc_nl'] = trim(htmlspecialchars($_POST['register-acc_nl']));
            }else{
                $args['acc_nl'] = "";
            }

            if ($this->registerUser($args)) {
                // we can handle the redirect after successful registration here or inside the funciton
                // $this->redirect = $this->buildUrl(array('view'=>'b_acc_general'));
            } else {
                $this->rep['email'] = $args['email'];
                $this->rep['tel'] = $args['tel'];
                $this->rep['username'] = $args['username'];
                $this->rep['firstname'] = $args['firstname'];
                $this->rep['lastname'] = $args['lastname'];
            }
        }elseif (isset($_POST['login'])) {

            $args = array();

            if (isset($_POST['login-username'])) {
                $args['username'] = trim(htmlspecialchars($_POST['login-username']));
            }else{
                $args['username'] = "";
            }
            if (isset($_POST['login-password'])) {
                $args['password'] = trim(htmlspecialchars($_POST['login-password']));
            }else{
                $args['password'] = "";
            }

            if ($this->loginWithPostData($args)) {
                if ($this->admin_status) {
                    $this->redirect = $this->buildUrl(array('view'=>"a_index"));
                } else {
                    $this->redirect = $this->buildUrl(array('view'=>'b_acc_general'));
                }
            }else{
                $this->rep['username'] = $args['username'];
            }
        }elseif (isset($_POST['ajxlogin'])) {

            $args = array();

            if (isset($_POST['username'])) {
                $args['username'] = trim(htmlspecialchars($_POST['ajxusr']));
            }else{
                $args['username'] = "";
            }
            if (isset($_POST['password'])) {
                $args['password'] = trim(htmlspecialchars($_POST['ajxpwd']));
            }else{
                $args['password'] = "";
            }
            $args['ajax'] = true;

            if ($this->loginWithPostData($args)) {
                $this->rep['ajxrsp'] = array('success'=>true);
            }else{
                $this->rep['ajxrsp'] = array('success'=>false, 'msg'=>"Emailul/Username-ul sau parola sunt greșite.");
            }
        }elseif (isset($_POST['acc_general_info'])) {

            $args = array();

            if (isset($_POST['acc-firstname'])) {
                $args['firstname'] = trim(htmlspecialchars($_POST['acc-firstname']));
            }else{
                $args['firstname'] = "";
            }
            if (isset($_POST['acc-lastname'])) {
                $args['lastname'] = trim(htmlspecialchars($_POST['acc-lastname']));
            }else{
                $args['lastname'] = "";
            }
            if (isset($_POST['acc-tel'])) {
                $args['tel'] = trim(htmlspecialchars($_POST['acc-tel']));
            }else{
                $args['tel'] = "";
            }
            if (isset($_POST['acc-username'])) {
                $args['username'] = trim(htmlspecialchars($_POST['acc-username']));
            }else{
                $args['username'] = "";
            }
            $args['ID'] = $this->ID;

            if ($this->accEditSettings($args)) {
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_general'));
            }
        }elseif (isset($_POST['acc_password_change'])) {

            // change the password from your own account

            $args = array();

            if (isset($_POST['pwch-passwordo'])) {
                $args['password_old'] = trim(htmlspecialchars($_POST['pwch-passwordo']));
            }else{
                $args['password_old'] = "";
            }
            if (isset($_POST['pwch-passwordn'])) {
                $args['password_new'] = trim(htmlspecialchars($_POST['pwch-passwordn']));
            }else{
                $args['password_new'] = "";
            }
            $args['ID'] = $this->ID;

            if ($this->accEditPassword($args)) {
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_security'));
            }
        }elseif (isset($_POST['acc_communications_change'])) {

            // change the password from your own account

            $args = array();

            if (isset($_POST['acc_nl'])) {
                $args['acc_nl'] = trim(htmlspecialchars($_POST['acc_nl']));
            }else{
                $args['acc_nl'] = "";
            }
            $args['ID'] = $this->ID;

            if ($this->accEditNewsletterSubscribe($args)) {
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_communication'));
            }
        }elseif (isset($_POST['acc_password_request_reset'])) {

            $args = array();

            if (isset($_POST['request-reset-email'])) {
                $args['email'] = trim(htmlspecialchars(strtolower($_POST['request-reset-email'])));
            }else{
                $args['email'] = "";
            }

            if ($this->accSendResetLinkEmail($args)) {
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_password_request_reset'));
            }
        }elseif (isset($_POST['acc_password_set'])) {

            // change the password after a password reset request

            $args = array();

            if (isset($_POST['pwch-passwordn'])) {
                $args['password_new'] = trim(htmlspecialchars($_POST['pwch-passwordn']));
            }else{
                $args['password_new'] = "";
            }
            if (isset($_POST['pwch-passwordr'])) {
                $args['password_repeat'] = trim(htmlspecialchars($_POST['pwch-passwordr']));
            }else{
                $args['password_repeat'] = "";
            }

            if (isset($_GET['trp'])) {
                $args['token_resetare_parola'] = trim(htmlspecialchars($_GET['trp']));
            }else{
                $args['token_resetare_parola'] = "";
            }


            if ($this->accResetPassword($args)) {
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_login'));
            }
        }elseif (isset($_POST['acc_send_confirm_link'])) {

            if (isset($_POST['confirmation-email'])) {
                $email = trim(htmlspecialchars(strtolower($_POST['confirmation-email'])));
            }else{
                $email = "";
            }

            // get user object
            $userObj = $this->getUserByEmail($email);

            if (isset($userObj->ID)) {
                // user exists
                if ($userObj->status==1) {
                    // resend the confirmation email only if the email isn't confirmed
                    if ($this->registerSendConfirmationEmail($userObj)) {
                        $_SESSION['msg_success'][] = "Linkul de confirmare a fost trimis.";
                    }
                }else{
                    $_SESSION['msg_warning'][] = "Adresa de email '".$email."' nu este eligibilă pentru confirmare.";
                }
            }else{
                $_SESSION['msg_errors'][] = "Adresa de email '".$email."' nu a fost găsită.";
            }
        }elseif (isset($_POST['acc_activate'])) {

            // admin function

            if (isset($_POST['tve'])) {
                $tve = trim(htmlspecialchars($_POST['tve']));
            }


            if ($this->registerConfirmUserAdminWrap($tve)) {
                #code ...
            }
        }elseif (isset($_POST['acc_delete'])) {
            if ($this->user_is_logged_in) {
                // code...
                if ($this->accDeleteFirstStep($this->ID)) {
                    $this->redirect = $this->buildUrl(array('view'=>'b_acc_login'));
                }
            }
        }elseif (isset($_POST['acc_recovery_request'])) {

            $args = array();

            if (isset($_POST['recovery-email'])) {
                $args['email'] = trim(htmlspecialchars(strtolower($_POST['recovery-email'])));
            }else{
                $args['email'] = "";
            }

            if ($this->accSendRecoveryLinkEmail($args)) {
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_recover'));
            }
        }elseif (isset($_POST['ajxfavfile'])) {

            $args = array();
            if (isset($_POST['idfile'])) {
                $args['id_file'] = intval(trim(htmlspecialchars($_POST['idfile'])));
            } else {
                $args['id_file'] = null;
            }
            if (isset($_POST['idusr'])) {
                $args['id_user'] = intval(trim(htmlspecialchars($_POST['idusr'])));
            } else {
                $args['id_user'] = null;
            }

            if ($this->filesAddRemoveToFavorite($args)) {
                // code... succcess
            }else{
                // code... fail
            }
        }



        if ($this->view=="b_acc_login") {

            $this->page_title = "Login";
            $this->page_description = "Let's do this!";
            if ($this->user_is_logged_in) {
                $this->redirect = $this->buildUrl(array('view'=>"b_acc_general"));
            }
        }elseif ($this->view=="b_acc_general") {
            if ($this->ID) {
                #code ...
            }else{
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_login'));
            }
        }elseif ($this->view=="b_acc_security") {
            if ($this->ID) {
                #code ...
            }else{
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_login'));
            }
        }elseif ($this->view=="b_acc_communication") {
            if ($this->ID) {
                #code ...
            }else{
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_login'));
            }
        }elseif ($this->view=="b_acc_delete_info") {
            if ($this->ID) {
                #code ...
            }else{
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_login'));
            }
        }elseif ($this->view=="b_acc_delete_confirm") {
            if ($this->ID) {
                #code ...
            }else{
                $this->redirect = $this->buildUrl(array('view'=>'b_acc_login'));
            }
        }elseif ($this->view=="b_acc_recover") {
            if ($this->user_is_logged_in) {
                $this->redirect = $this->buildUrl(array('view'=>"b_acc_general"));
            }
        }elseif ($this->view=="b_acc_recover_confirm") {
            if ($this->user_is_logged_in) {
                $this->redirect = $this->buildUrl(array('view'=>"b_acc_general"));
            }else{
                if (isset($_GET['tra'])) {
                    $tra = trim(htmlspecialchars($_GET['tra']));
                }else{
                    $tra = "";
                }
                $this->accRecoveryConfirm($tra);
            }
        }elseif ($this->view=="b_acc_password_request_reset") {
            
            #code ...
        }elseif ($this->view=="b_acc_password_set") {
            if (!isset($_POST['acc_password_set'])) {
                if (isset($_GET['trp'])) {
                    $token_resetare_parola = trim(htmlspecialchars($_GET['trp']));
                    $checkUser = $this->getUserByTokenResetareParola($token_resetare_parola);
                    if (isset($checkUser->ID)) {
                        $this->rep['user'] = $checkUser;
                    }else{
                        $_SESSION['msg_errors'][] = "Linkul este greșit sau a expirat.<br>Trimite din nou cererea pentru resetarea parolei.";
                        $this->redirect = $this->buildUrl(array('view'=>"b_acc_password_request_reset"));
                    }
                }else{
                    $_SESSION['msg_errors'][] = "Linkul este greșit sau a expirat.<br>Trimite din nou cererea pentru resetarea parolei.";
                    $this->redirect = $this->buildUrl(array('view'=>"b_acc_password_request_reset"));
                }
            }
        }elseif ($this->view=="b_acc_register") {
            
            if ($this->user_is_logged_in) {
                $this->redirect = $this->buildUrl(array('view'=>"b_acc_general"));
            }
        }elseif ($this->view=="b_acc_register_success") {
            
            if ($this->user_is_logged_in) {
                $this->redirect = $this->buildUrl(array('view'=>"b_acc_general"));
            }
        }elseif ($this->view=="b_acc_register_confirm") {
            if ($this->user_is_logged_in) {
                $this->redirect = $this->buildUrl(array('view'=>"b_acc_general"));
            }else{
                if (isset($_GET['tve'])) {
                    $tve = trim(htmlspecialchars($_GET['tve']));
                }else{
                    $tve = "";
                }
                $this->registerConfirmUser($tve);
            }
        }elseif ($this->view=="b_acc_seteaza_parola") {
            
            #code ...
        }elseif ($this->view=="f_404") {

            $this->page_title = "404";
            $this->page_description = "Vai! Cum de ai ajuns aici?";
        }elseif ($this->view=="f_index") {

            $this->page_title = "Two & From - CMS";
            $this->page_description = "Atinge întregul potențial al organzației tale";
        }elseif ($this->view=="f_about") {

            $this->pageSel2 = true;
            $this->page_title = "ORA - Despre";
            $this->page_description = "Ajutăm organizația ta să prospere într-un mediu de afaceri dinamic";
        }elseif ($this->view=="f_contact") {

            $this->page_title = "ORA - Contact";
            $this->page_description = "Suntem aici pentru a te ajuta";
        }elseif ($this->view=="f_policy_cf") {

            $this->page_title = "Politica de confindețialitate a platformei";
            $this->page_description = "Sintem PRO transparență dar nu în detrimentul confindețialității.";
        }elseif ($this->view=="f_policy_ck") {

            $this->page_title = "Politica de cookies a platformei";
            $this->page_description = "Prăjiturile sunt din partea casei.";
        }elseif ($this->view=="f_policy_tc") {

            $this->page_title = "Termenii și condițiile de folosire a platformei";
            $this->page_description = "Am încercat să ținem această pagină cât mai scurtă și mai clară posibil.";
        }elseif ($this->view=="f_services") {

            $this->pageSel2 = true;
            $this->page_title = "ORA - Servicii";
            $this->page_description = "Servicii de managementul riscului și inteligența în afaceri";
        }elseif ($this->view=="f_generate_view") {
            $args = array();
            if (isset($_GET['hash'])) {
                $args['hash'] = trim(htmlspecialchars($_GET['hash']));
            }else{
                $args['hash'] = "";
            }

            $this->filesGenerateFileView($args);
        }elseif ($this->view=="f_generate_download") {
        }
    }









    public function doLogout(){
        if (isset($_COOKIE['rememberme'])){
            $this->deleteRememberMeCookie();
        }
        $_SESSION = array();
        session_destroy();
        $this->user_is_logged_in = false;
    }
    protected function deleteRememberMeCookie() {
        list($ID, $token, $hash) = explode('_', $_COOKIE['rememberme']);
        if ($this->databaseConnection()&&!empty($ID)) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `token_rememberme`=NULL 
                WHERE 
                    `ID`=:ID
                ");
            $q->bindValue(":ID", $ID, PDO::PARAM_INT);
            $q->execute();
            $r = $q->rowCount();
            $q = null;
            if ($r>0) {
                setcookie('rememberme', false, (time()-(3600*3650)), '/', COOKIE_DOMAIN);
                return true;
            }
        }
        return false;
    }
    protected function newRememberMeCookie() {
        $random_token_string = hash('sha256', mt_rand());
        $cookie_string_first_part = $this->ID.'_'.$random_token_string;
        $cookie_string_hash = hash('sha256', $cookie_string_first_part.COOKIE_SECRET_KEY);
        $cookie_string = $cookie_string_first_part.'_'.$cookie_string_hash;
        
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `token_rememberme`=:token_rememberme 
                WHERE 
                    `ID`=:ID
                ");
            $q->bindValue(":token_rememberme", $random_token_string, PDO::PARAM_STR);
            $q->bindValue(":ID", $this->ID, PDO::PARAM_INT);
            $q->execute();
            $r = $q->rowCount();
            $q = null;
            if ($r>0) {
                setcookie('rememberme', $cookie_string, (time()+COOKIE_RUNTIME), '/', COOKIE_DOMAIN);
                return true;
            }
        }
        return false;
    }
    protected function generateTokenValidareEmail() {
        $token_validare_email = sha1(uniqid(mt_rand(), true));
        $checkToken = $this->getUserByTokenValidareEmail($token_validare_email);
        if (isset($checkToken->ID)) {
            $token_validare_email = $this->generateTokenValidareEmail();
        }

        return $token_validare_email;
    }
    protected function generateTokenResetPassword() {
        $token_resetare_parola = sha1(uniqid(mt_rand(), true));
        $checkToken = $this->getUserByTokenResetareParola($token_resetare_parola);
        if (isset($checkToken->ID)) {
            $token_resetare_parola = $this->generateTokenResetPassword();
        }

        return $token_resetare_parola;
    }









    protected function setValues( $user ) {

        if ( isset($user->ID) ) {


            $this->ID = $user->ID;
            $this->username = $user->username;
            $this->password = $user->password;
            $this->token_rememberme = $user->token_rememberme;
            $this->admin_status = $user->admin_status;
            $this->firstname_user = $user->firstname_user;
            $this->lastname_user = $user->lastname_user;
            $this->email_user = $user->email_user;
            $this->tel_user = $user->tel_user;
            $this->status = $user->status;
            $this->created_time = $user->created_time;
            $this->token_validare_email = $user->token_validare_email;

            $this->acc_nl = $user->acc_nl;
            $this->acc_nl_time = $user->acc_nl_time;

            $this->delete_time = $user->delete_time;

            if ($this->status==1) {
                if (empty($this->token_validare_email)) {
                    // code...
                    $this->token_validare_email = $this->generateTokenValidareEmail();
                    if (!$this->accEditTokenValidareEmail($this->ID, $this->token_validare_email)) {
                        # code...
                    }
                }
            }
        }
    }
    protected function refreshUser() {
        $refresh = $this->getUserById($this->ID);
        $this->setValues($refresh);
        return true;
    }
    protected function loginWithCookieData() {
        list($ID, $token, $hash) = explode('_', $_COOKIE['rememberme']);
        if ($hash == hash('sha256', $ID.'_'.$token.COOKIE_SECRET_KEY) && !empty($token)) {
            $user = $this->getUserByTokenRememberme($ID, $token);

            if (isset($user->ID)) {
                $this->setValues($user);
                $_SESSION['loggedin'] = true;
                $_SESSION['id_user'] = $user->ID;
                $this->user_is_logged_in = true;
                return true;
            }
        }
        $this->deleteRememberMeCookie();
        return false;
    }
    protected function loginWithSessionData() {
        $id_user = $_SESSION['id_user'];
        $user = $this->getUserById($id_user);

        if (isset($user->ID)) {
            $this->setValues($user);
            $this->user_is_logged_in = true;
        }else {
            $this->doLogout();
        }
    }
    protected function loginWithPostData( $params=array() ) {

        $username = isset($params['username'])?$params['username']:"";
        $password = isset($params['password'])?$params['password']:"";
        $ajax = isset($params['ajax'])?$params['ajax']:false;

        if (empty($username) || strlen($username) > 256 ){
            $this->errflag = true;
            $this->rep['errors']['username'] = "is-invalid";
        }
        if (empty($password)) {
            $this->errflag = true;
            $this->rep['errors']['password'] = "is-invalid";
        }
        if ($this->errflag) {
            return false;
        }

        $username=strtolower($username);
        $user = $this->getUserByEmail($username);
        
        if (!isset($user->ID)) {

            if (!$ajax) {
                $_SESSION['msg_errors'][] = "Emailul sau parola sunt greșite.";
            }
        }elseif (!password_verify($password, $user->password)) {

            if (!$ajax) {
                $_SESSION['msg_errors'][] = "Emailul sau parola sunt greșite...";
            }
        }elseif ($user->status==-1) {
            $_SESSION['msg_warning'][] = 'Contul este șters. Îl poți recupera <a href="'.$this->buildUrl(array('view'=>'b_acc_recover')).'">aici</a> până la data de '.$user->delete_time;
        }elseif ($user->status==1) {
            $_SESSION['msg_warning'][] = 'Pentru a continua trebuie sa confirmati adresa de email accesând linkul din mesajul primit. Dacă nu ați primit mesajul îl puteți cere încă o data de <a href="'.$this->buildUrl(array('view'=>'b_acc_register_confirm_send')).'">aici</a>';
        }elseif ($user->status==2) {
            $_SESSION['msg_warning'][] = 'Adresa de email a fost confirmată, un moderator va activa contul în curând.';
        }elseif ($user->status==3) {
            $this->user_is_logged_in = true;
            $this->setValues($user);
            $_SESSION['loggedin'] = true;
            $_SESSION['id_user'] = $user->ID;
            $this->newRememberMeCookie();



            $args = array();
            $args['id_user'] = $this->ID;
            $args['target_table'] = "users";
            $args['id_target'] = $this->ID;
            $args['note'] = "User &ldquo;".$this->username."&rdquo; logged in.";
            $this->logAction($args);

            return true;
        }
        return false;
    }









    protected function getUserById( $id_user ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    *, 
                    AES_DECRYPT(`firstname`, :secretkey) AS firstname_user, 
                    AES_DECRYPT(`lastname`, :secretkey) AS lastname_user, 
                    AES_DECRYPT(`email`, :secretkey) AS email_user, 
                    AES_DECRYPT(`tel`, :secretkey) AS tel_user 
                FROM `users` 
                WHERE 
                    `ID`=:id_user
                ");
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function getUserByUsername( $username ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    *, 
                    AES_DECRYPT(`firstname`, :secretkey) AS firstname_user, 
                    AES_DECRYPT(`lastname`, :secretkey) AS lastname_user, 
                    AES_DECRYPT(`email`, :secretkey) AS email_user, 
                    AES_DECRYPT(`tel`, :secretkey) AS tel_user 
                FROM `users` 
                WHERE 
                    `username`=:username
                ");
            $q->bindValue(":username", $username, PDO::PARAM_STR);
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function getUserByEmail( $email ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    *, 
                    AES_DECRYPT(`firstname`, :secretkey) AS firstname_user, 
                    AES_DECRYPT(`lastname`, :secretkey) AS lastname_user, 
                    AES_DECRYPT(`email`, :secretkey) AS email_user, 
                    AES_DECRYPT(`tel`, :secretkey) AS tel_user 
                FROM `users` 
                WHERE 
                    AES_DECRYPT(`email`, :secretkey)=:email
            ");
            $q->bindValue(":email", $email, PDO::PARAM_STR);
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function getUserByTel( $tel ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    *, 
                    AES_DECRYPT(`firstname`, :secretkey) AS firstname_user, 
                    AES_DECRYPT(`lastname`, :secretkey) AS lastname_user, 
                    AES_DECRYPT(`email`, :secretkey) AS email_user, 
                    AES_DECRYPT(`tel`, :secretkey) AS tel_user 
                FROM `users` 
                WHERE 
                    AES_DECRYPT(`tel`, :secretkey)=:tel
            ");
            $q->bindValue(":tel", $tel, PDO::PARAM_STR);
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function getUserByTokenValidareEmail( $token_validare_email ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    *, 
                    AES_DECRYPT(`firstname`, :secretkey) AS firstname_user, 
                    AES_DECRYPT(`lastname`, :secretkey) AS lastname_user, 
                    AES_DECRYPT(`email`, :secretkey) AS email_user, 
                    AES_DECRYPT(`tel`, :secretkey) AS tel_user 
                FROM `users` 
                WHERE 
                    `token_validare_email`=:token_validare_email
            ");
            $q->bindValue(":token_validare_email", $token_validare_email, PDO::PARAM_STR);
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function getUserByTokenResetareParola( $token_resetare_parola ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    *, 
                    AES_DECRYPT(`firstname`, :secretkey) AS firstname_user, 
                    AES_DECRYPT(`lastname`, :secretkey) AS lastname_user, 
                    AES_DECRYPT(`email`, :secretkey) AS email_user, 
                    AES_DECRYPT(`tel`, :secretkey) AS tel_user 
                FROM `users` 
                WHERE 
                    `token_resetare_parola`=:token_resetare_parola 
                    AND `trp_time`>NOW()
            ");
            $q->bindValue(":token_resetare_parola", $token_resetare_parola, PDO::PARAM_STR);
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function getUserByTokenRememberme( $id_user, $token_rememberme ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    *, 
                    AES_DECRYPT(`firstname`, :secretkey) AS firstname_user, 
                    AES_DECRYPT(`lastname`, :secretkey) AS lastname_user, 
                    AES_DECRYPT(`email`, :secretkey) AS email_user, 
                    AES_DECRYPT(`tel`, :secretkey) AS tel_user 
                FROM `users` 
                WHERE 
                    `token_rememberme`=:token_rememberme 
                    AND `ID`=:id_user
                ");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);
            $q->bindValue(":token_rememberme", $token_rememberme, PDO::PARAM_STR);
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }









    protected function registerUser( $params ) {

        $username = isset($params['username'])?$params['username']:"";
        $password = isset($params['password'])?$params['password']:"";
        $firstname = isset($params['firstname'])?$params['firstname']:"";
        $lastname = isset($params['lastname'])?$params['lastname']:"";
        $email = isset($params['email'])?$params['email']:"";
        $tel = isset($params['tel'])?$params['tel']:"";
        $acc_nl = isset($params['acc_nl'])?$params['acc_nl']:"";
        $acc_tc = isset($params['acc_tc'])?$params['acc_tc']:"";

        /* username required */
        if (empty($username)) {
            $_SESSION['msg_errors'][] = "Vă rugăm să completați câmpul &ldquo;Username&rdquo;";
            $this->rep['errors']['username'] = "is-invalid";
            $this->errflag = true;
        }else {
            $checkUsername = $this->getUserByUsername($username);
            if (isset($checkUsername->ID)) {
                $this->errflag = true;
                $_SESSION['msg_errors'][] = "Username-ul &ldquo;".$username."&rdquo; este deja folosit.";
                $this->rep['errors']['username'] = "is-invalid";
            }
        }

        /* password required */
        if (empty($password)) {
            $_SESSION['msg_errors'][] = "Vă rugăm să completați câmpul parola";
            $this->rep['errors']['password'] = "is-invalid";
            $this->errflag = true;
        }else {
            $user_password_hash = password_hash($password, PASSWORD_DEFAULT);
        }

        /* firstname required */
        if (empty($firstname)) {
            $_SESSION['msg_errors'][] = "Vă rugăm să completați câmpul &ldquo;Prenume&rdquo;";
            $this->rep['errors']['firstname'] = "is-invalid";
            $this->errflag = true;
        }

        /* lastname required */
        if (empty($lastname)) {
            $_SESSION['msg_errors'][] = "Vă rugăm să completați câmpul &ldquo;Nume&rdquo;";
            $this->rep['errors']['lastname'] = "is-invalid";
            $this->errflag = true;
        }

        /* email required */
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg_errors'][] = "Vă rugăm să completați corect câmpul email";
            $this->rep['errors']['email'] = "is-invalid";
            $this->errflag = true;
        }else {
            $checkEmail = $this->getUserByEmail($email);
            if (isset($checkEmail->ID)) {
                $_SESSION['msg_errors'][] = "Adresa e-mail ".$email." este deja folosită";
                $this->rep['errors']['email'] = "is-invalid";
                $this->errflag = true;
            }
        }

        /* tel required */
        if(!preg_match("/07[0-9]{8}$/", $tel)) {
            $_SESSION['msg_errors'][] = "Vă rugăm să completați corect câmpul tel. Exemplu: 07XXXXXXXX";
            $this->rep['errors']['tel'] = "is-invalid";
            $this->errflag = true;
        }else {
            $checktel = $this->getUserByTel($tel);
            if (isset($checktel->ID)) {
                $_SESSION['msg_errors'][] = "Numărul de tel este deja folosit";
                $this->rep['errors']['tel'] = "is-invalid";
                $this->errflag = true;
            }
        }

        /* accord terms & conditions required */
        if ($acc_tc!="da") {
            $_SESSION['msg_errors'][] = "Vă rugăm să acceptați termenii și condițiile site-ului.";
            $this->rep['errors']['acc_tc'] = "is-invalid";
            $this->errflag = true;
        }

        /* accord newsletter required */
        if ($acc_nl!="da") {
            $acc_nl = "nu";
        }

        /* stop if fields validation has any error */
        if ($this->errflag) {
            return false;
        }

        /*
        dev stop before insert
        return false;
        */

        if ($this->databaseConnection()) {
            /* generate unique token for email account validation */
            $token_validare_email = $this->generateTokenValidareEmail();

            $q = $this->db_connection->prepare("
                INSERT INTO `users`(
                    `username`,
                    `password`,
                    `status`,
                    `token_validare_email`,
                    `firstname`,
                    `lastname`,
                    `email`,
                    `tel`,
                    `acc_nl`,
                    `acc_nl_time`,
                    `created_time`
                )
                VALUES (
                    :username,
                    :password,
                    '1',
                    :token_validare_email,
                    AES_ENCRYPT(:firstname, :secretkey), 
                    AES_ENCRYPT(:lastname, :secretkey), 
                    AES_ENCRYPT(:email, :secretkey), 
                    AES_ENCRYPT(:tel, :secretkey), 
                    :acc_nl,
                    NOW(),
                    NOW()
                )
            ");
            $q->bindValue(":username", $username, PDO::PARAM_STR);
            $q->bindValue(":password", $user_password_hash, PDO::PARAM_STR);
            $q->bindValue(":token_validare_email", $token_validare_email, PDO::PARAM_STR);
            $q->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            $q->bindValue(":lastname", $lastname, PDO::PARAM_STR);
            $q->bindValue(":email", $email, PDO::PARAM_STR);
            $q->bindValue(":tel", $tel, PDO::PARAM_STR);
            $q->bindValue(":acc_nl", $acc_nl, PDO::PARAM_STR);
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);

            $q->execute();
            $r = $q->rowCount();
            $q = null;
            if ($r>0) {
                $userObj = $this->getUserByEmail($email);
                if (!$this->registerSendConfirmationEmail($userObj)) {
                    $_SESSION['msg_errors'][] = "A apărut o eroare la trimiterea mesajului email de confirmare.";

                    // $this->redirect = $this->buildUrl(array('view'=>"b_acc_register_success"));
                }else{
                    // $this->redirect = $this->buildUrl(array('view'=>"b_acc_register_success"));
                }
                $this->redirect = $this->buildUrl(array('view'=>"b_acc_register_success"));

                if (true) {
                    // additional code before email confirmation
                } else {
                    // there is the posibility to let people log in without confirming the email

                    
                    $this->user_is_logged_in = true;
                    $this->setValues($user);
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id_user'] = $user->ID;
                    $this->newRememberMeCookie();

                    $this->redirect = $this->buildUrl(array('view'=>"b_acc_general"));
                }                

                $_SESSION['msg_success'][] = "Contul a fost creat cu succes.";
                return true;
            }
        }
        return false;
    }
    protected function registerSendConfirmationEmail( $userObj ) {
        $link_activare_cont = BASE_URL.$this->buildUrl(array('view'=>'b_acc_register_confirm', 'tve'=>$userObj->token_validare_email));
        $email = $userObj->email_user;
        $subject = "PLATFORM_NAME: "."Confirmare adresa email";
        $name = $userObj->firstname_user." ".$userObj->lastname_user;
        $platform_name = "PLATFORM_NAME";


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, MJ_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('mode'=>"sendRegisterFormEmail", 'link_activare_cont'=>$link_activare_cont, 'email'=>$email, 'subject'=>$subject, 'name'=>$name, 'platform_name'=>$platform_name)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = json_decode(curl_exec($ch));

        curl_close ($ch);

        // $_SESSION['msg_warning'][] = "1016: ".$server_output->success;

        return $server_output->success;
    }
    protected function registerConfirmUser( $token_validare_email ) {

        // user can be logged in without email confirmed (from older version)

        $checkUser = $this->getUserByTokenValidareEmail( $token_validare_email );
        if (!isset($checkUser->ID)) {
            // token_validare_email invalid
            if ($this->ID) {
                // message with redirect to acc where he can request a new link
                $_SESSION['msg_warning'][] = 'Linkul este nu mai este valabil. În cazul în care ai validat deja emailul <a href="'.$this->buildUrl(array('view'=>'b_acc_general')).'">intră în cont</a>';
            }else{
                // message with redirect to acc where he can request a new link
                $_SESSION['msg_warning'][] = 'Linkul este nu mai este valabil. Cere <a href="'.$this->buildUrl(array('view'=>'b_acc_register_confirm_send')).'">aici</a> să fie retrimis emailul de confirmare. În cazul în care ai validat deja emailul <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">intră în cont</a>';

                // message with login popup in case user cand be logged in without email confirmation
                // $_SESSION['msg_warning'][] = 'Linkul este nu mai este valabil. În cazul în care ai validat deja emailul <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">intră în cont</a>';
                $this->errflag = true;
            }
        }elseif ($checkUser->status==-1) {
            $_SESSION['msg_errors'][] = "Contul este șters.";
            $this->errflag = true;
        }elseif ($checkUser->status==0) {
            $_SESSION['msg_errors'][] = "Contul este blocat.";
            $this->errflag = true;
        }elseif ($checkUser->status==2) {

            // peding admin action
            $_SESSION['msg_warning'][] = 'Adresa de email a fost confirmată. Un moderator va activa contul în curând.';
            $this->errflag = true;
        }else{
            // at this point $checkUser->status should be either 1 and token_validare_email should be ok or 3 and token_validare_email should be null and would get the message that the link is not ok anymore
        }

        if ($this->errflag) {
            return false;
        }

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `status`=2, 
                    `email_confirmation_time`=NOW() 
                WHERE 
                    `ID`=:ID
            ");
            $q->bindValue(":ID", $checkUser->ID, PDO::PARAM_INT);

            $r = $q->execute();
            $q = null;
            if ($r) {

                $_SESSION['msg_success'][] = 'Adresa de email a fost confirmată. Un moderator va activa contul în curând.';

                
                // in case the intervention of a moderator is not wanted
                // $_SESSION['msg_success'][] = "Adresa de e-mail a fost confirmată. Acum te poți autentifica.";                    
                // $this->redirect = $this->buildUrl(array('view'=>"b_acc_login"));
                

                // in case we want to automaticaly login the user on email confirmation
                // $this->user_is_logged_in = true;
                // $this->setValues($checkUser);
                // $_SESSION['loggedin'] = true;
                // $_SESSION['id_user'] = $checkUser->ID;
                // $this->newRememberMeCookie();
                // $this->redirect = $this->buildUrl(array('view'=>'b_acc_general'));

                return true;
            }
        }
        return false;
    }

    // Admin function
    protected function registerConfirmUserAdminWrap( $token_validare_email ) {

        // user can be logged in without email confirmed (from older version)

        $checkUser = $this->getUserByTokenValidareEmail( $token_validare_email );
        if (!isset($checkUser->ID)) {
            // token_validare_email invalid
            $_SESSION['msg_warning'][] = 'Linkul este nu mai este valabil.';
            return false;
        }elseif ($checkUser->status==-1) {
            $_SESSION['msg_errors'][] = "Contul este blocat.";
            $this->errflag = true;
        }else{
            $_SESSION['msg_warning'][] = 'Status: '.$checkUser->status;
        }

        if ($this->errflag) {
            return false;
        }

        if ($this->registerConfirmUserAdmin( $checkUser )) {
            $this->redirect = $this->buildUrl(array('view'=>"b_acc_login"));
            return true;
        }

        return false;
    }
    protected function registerConfirmUserAdmin( $userObj ) {

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `status`=3, 
                    `token_validare_email`=NULL 
                WHERE 
                    `ID`=:ID
            ");
            $q->bindValue(":ID", $userObj->ID, PDO::PARAM_INT);

            $r = $q->execute();
            $q = null;
            if ($r) {

                if (!$this->registerSendAccountActivatedEmail($userObj)) {
                    $_SESSION['msg_errors'][] = "A apărut o eroare la trimiterea mesajului email de confirmare.";

                    // $this->redirect = $this->buildUrl(array('view'=>"b_acc_register_success"));
                }else{
                    // $this->redirect = $this->buildUrl(array('view'=>"b_acc_register_success"));
                }
                return true;
            }
        }
        return false;
    }
    // Admin function
    protected function registerSendAccountActivatedEmail( $userObj ) {

        $link_activare_cont = BASE_URL.$this->buildUrl(array('view'=>'b_acc_login'));
        $email = $userObj->email_user;
        $subject = "PLATFORM_NAME: "."Contul a fost activat";
        $name = $userObj->firstname_user." ".$userObj->lastname_user;
        $platform_name = "PLATFORM_NAME";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, MJ_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('mode'=>"sendAccountActivated", 'link_activare_cont'=>$link_activare_cont, 'email'=>$email, 'subject'=>$subject, 'name'=>$name, 'platform_name'=>$platform_name)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = json_decode(curl_exec($ch));

        curl_close ($ch);

        return $server_output->success;
    }









    protected function accSendNewSubscribeValueToMj( $userObj, $acc_nl ) {
        if ($acc_nl=="da") {
            $action = "addforce";
        }else{
            $action = "unsub";
        }
        $email = $userObj->email_user;
        $name = $userObj->firstname_user." ".$userObj->lastname_user;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, MJ_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('mode'=>"sendSub", 'email'=>$email, 'action'=>$action, 'name'=>$name)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = json_decode(curl_exec($ch));

        curl_close ($ch);

        return $server_output->success;
    }
    protected function accEditPassword( $params ) {

        $password_old = isset($params['password_old'])?$params['password_old']:"";
        $password_new = isset($params['password_new'])?$params['password_new']:"";
        $id_user = isset($params['ID'])?$params['ID']:"";

        if (!password_verify($password_old, $this->password)) {
            $this->rep['errors']['password'] = "is-invalid";
            $_SESSION['msg_errors'][] = "Vechea parolă este greșită.";
            return false;
        }

        $user_password_hash = password_hash($password_new, PASSWORD_DEFAULT);

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `password`=:password, 
                    `modified_time`=NOW() 
                WHERE 
                    `ID`=:id_user
            ");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);
            $q->bindValue(":password", $user_password_hash, PDO::PARAM_STR);

            $r = $q->execute();
            $q = null;
            if ($r) {
                $_SESSION['msg_success'][] = "Parola a fost modificată.";
                return true;
            }
        }
        return false;
    }
    protected function accEditTokenValidareEmail( $id_user, $token_validare_email ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `token_validare_email`=:token_validare_email 
                WHERE 
                    `ID`=:id_user
            ");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);
            $q->bindValue(":token_validare_email", $token_validare_email, PDO::PARAM_STR);

            $r = $q->execute();
            $q = null;
            if ($r) {
                return true;
            }
        }
        return false;
    }
    protected function accSendResetLinkEmail( $params ) {

        $email = isset($params['email'])?$params['email']:"";
        $userObj = $this->getUserByEmail($email);
        if (!isset($userObj->ID)) {
            $_SESSION['msg_errors'][] = "Adresa e-mail inexistenta.";
            $this->rep['errors']['email'] = "is-invalid";
            return false;
        }

        $token_resetare_parola = $this->generateTokenResetPassword();
        $link_activare_cont = BASE_URL.$this->buildUrl(array('view'=>'b_acc_password_set', 'trp'=>$token_resetare_parola));
        $email = $userObj->email_user;
        $subject = "PLATFORM_NAME: "."Resetare parola";
        $name = $userObj->firstname_user." ".$userObj->lastname_user;
        $platform_name = "PLATFORM_NAME";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, MJ_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('mode'=>"sendResetPasswordEmail", 'link_activare_cont'=>$link_activare_cont, 'email'=>$email, 'subject'=>$subject, 'name'=>$name, 'platform_name'=>$platform_name)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = json_decode(curl_exec($ch));

        curl_close ($ch);

        // $_SESSION['msg_warning'][] = "1016: ".$server_output->success;

        if ($server_output->success) {
            if ($this->accEditTokenResetareParola($userObj->ID, $token_resetare_parola)) {
                # code...
            }
            $_SESSION['msg_success'][] = "A fost trimis un email cu linkul pentru resetarea parolei. Vă rugăm să urmăriți instrucțiunile din email pentru a reseta parola.";
            return true;
        }else{
            $_SESSION['msg_errors'][] = "A apărut o eroare la trimiterea unui email cu linkul pentru resetarea parolei. Vă rugăm să încercați mai târziu.";
        }
        return false;
    }
    protected function accEditTokenResetareParola( $id_user, $token_resetare_parola ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `token_resetare_parola`=:token_resetare_parola, 
                    `trp_time`=NOW() + INTERVAL 2 DAY
                WHERE 
                    `ID`=:id_user
            ");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);
            $q->bindValue(":token_resetare_parola", $token_resetare_parola, PDO::PARAM_STR);

            $r = $q->execute();
            $q = null;
            if ($r) {
                return true;
            }
        }
        return false;
    }
    protected function accResetPassword( $params ) {

        $password_new = isset($params['password_new'])?$params['password_new']:"";
        $password_repeat = isset($params['password_repeat'])?$params['password_repeat']:"";
        $token_resetare_parola = isset($params['token_resetare_parola'])?$params['token_resetare_parola']:"";

        $checkUser = $this->getUserByTokenResetareParola($token_resetare_parola);
        if (!isset($checkUser->ID)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Linkul este greșit sau a expirat.<br>Trimite din nou cererea pentru resetarea parolei.";
            $this->redirect = $this->buildUrl(array('view'=>'b_acc_password_request_reset'));
        }
        if (empty($password_new)||empty($password_repeat)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Parola trebuie să conțina cel puțin un caracter.";
        }elseif ($password_new!==$password_repeat) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Câmpurile &ldquo;Parola&rdquo; și &ldquo;Repetă parola&rdquo; trebuie să fie identice.";
        }
        if ($this->errflag) {
            return false;
        }

        $user_password_hash = password_hash($password_new, PASSWORD_DEFAULT);

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `password`=:password, 
                    `token_resetare_parola`=NULL, 
                    `trp_time`=NULL 
                WHERE 
                    `ID`=:id_user
            ");
            $q->bindValue(":id_user", $checkUser->ID, PDO::PARAM_INT);
            $q->bindValue(":password", $user_password_hash, PDO::PARAM_STR);

            $r = $q->execute();
            $q = null;
            if ($r) {
                $_SESSION['msg_success'][] = "Parola a fost modificată.";

                // autologin section
                // $_SESSION['loggedin'] = true;
                // $_SESSION['id_user'] = $checkUser->ID;
                // $this->newRememberMeCookie();

                $this->redirect = $this->buildUrl(array('view'=>'b_acc_login'));
                return true;
            }else{
                $_SESSION['msg_errors'][] = "Eroare la modificarea parolei.";
            }
        }
        return false;
    }
    protected function accEditSettings( $params ) {

        $firstname = isset($params['firstname'])?$params['firstname']:'';
        $lastname = isset($params['lastname'])?$params['lastname']:'';
        $tel = isset($params['tel'])?$params['tel']:'';
        $username = isset($params['username'])?$params['username']:'';
        $id_user = isset($params['ID'])?$params['ID']:null;

        $oldValues = $this->getUserById($id_user);

        if (empty($firstname)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Prenumele este câmp obligatoriu.";
            $this->rep['errors']['firstname'] = "is-invalid";
        }
        if (empty($lastname)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Numele este câmp obligatoriu.";
            $this->rep['errors']['lastname'] = "is-invalid";
        }

        if(!preg_match("/07[0-9]{8}$/", $tel)) {
            $_SESSION['msg_errors'][] = "Vă rugăm să completați corect câmpul tel. Exemplu: 07XXXXXXXX";
            $this->rep['errors']['tel'] = "is-invalid";
            $this->errflag = true;
        }else {
            $checktel = $this->getUserByTel($tel);
            if (isset($checktel->ID)&&$checktel->ID!=$id_user) {
                $_SESSION['msg_errors'][] = "Numărul de tel &ldquo;".$tel."&rdquo; este deja folosit";
                $this->rep['errors']['tel'] = "is-invalid";
                $this->errflag = true;
            }
        }

        if (empty($username)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Username este câmp obligatoriu.";
            $this->rep['errors']['username'] = "is-invalid";
        }else{
            $checkUsername = $this->getUserByUsername($username);
            if (isset($checkUsername->ID)&&$checkUsername->ID!=$id_user) {
                $this->errflag = true;
                $_SESSION['msg_errors'][] = "Username-ul &ldquo;".$username."&rdquo; este deja folosit.";
                $this->rep['errors']['username'] = "is-invalid";
            }
        }

        if ($this->errflag) {
            return false;
        }

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `username`=:username, 
                    `firstname`=AES_ENCRYPT(:firstname, :secretkey), 
                    `lastname`=AES_ENCRYPT(:lastname, :secretkey), 
                    `tel`=AES_ENCRYPT(:tel, :secretkey), 
                    `modified_time`=NOW() 
                WHERE 
                    `ID`=:id_user
            ");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);
            $q->bindValue(":username", $username, PDO::PARAM_STR);
            $q->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            $q->bindValue(":lastname", $lastname, PDO::PARAM_STR);
            $q->bindValue(":tel", $tel, PDO::PARAM_STR);
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);

            $r = $q->execute();
            $q = null;
            if ($r) {
                $_SESSION['msg_success'][] = "Modificările au fost salvate.";
                return true;
            }
        }
        return false;
    }
    protected function accEditNewsletterSubscribe( $params ) {

        $acc_nl = isset($params['acc_nl'])?$params['acc_nl']:'nu';
        $acc_nl = ($acc_nl=="da")?$acc_nl:"nu";
        $id_user = isset($params['ID'])?$params['ID']:null;

        $oldValues = $this->getUserById($id_user);

        if ($oldValues->acc_nl==$acc_nl) {
            // same thing not going to do anything but the alert is warning not succcess
            $_SESSION['msg_warning'][] = "Modificările au fost salvate";
            return true;
        }

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `acc_nl`=:acc_nl, 
                    `acc_nl_time`=NOW() 
                WHERE 
                    `ID`=:id_user
            ");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);
            $q->bindValue(":acc_nl", $acc_nl, PDO::PARAM_STR);

            $r = $q->execute();
            $q = null;
            if ($r) {
                $_SESSION['msg_success'][] = "Modificările au fost salvate.";

                if ($acc_nl!=$oldValues->acc_nl) {
                    if ($this->accSendNewSubscribeValueToMj($oldValues, $acc_nl)) {
                        // $_SESSION['msg_success'][] = "accSendNewSubscribeValueToMj() $acc_nl";
                    }
                }
                return true;
            }
        }
        return false;
    }
    protected function accDeleteFirstStep( $id_user ) {

        $oldValues = $this->getUserById($id_user);

        if (!isset($oldValues->ID)) {
            $_SESSION['msg_errors'][] = "Utilizatorul nu a fost găsit.";
            return false;
        }

        if ($oldValues->acc_nl=="da") {
            if ($this->accSendNewSubscribeValueToMj($oldValues, "nu")) {
                // code...
            }
        }

        // other code...

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `status`='-1', 
                    `delete_time`=NOW() + INTERVAL 15 DAY, 
                    `acc_nl`='nu', 
                    `acc_nl_time`=NOW() 
                WHERE 
                    `ID`=:id_user
            ");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);

            $r = $q->execute();
            $q = null;
            if ($r) {
                #$_SESSION['msg_success'][] = "Contul a fost șters. Contul se mai poate recupera în decurs de 15 zile";

                if ($this->ID==$id_user) {
                    // logout if de delete action is done by the owner of the account
                    $this->doLogout();
                }
                return true;
            }
        }
        return false;
    }
    protected function accDeleteFinalStep( $id_user ) {

        $oldValues = $this->getUserById($id_user);

        if (!isset($oldValues->ID)) {
            // $_SESSION['msg_errors'][] = "Utilizatorul nu a fost găsit.";
            return true;
        }

        // in case the user is still subscribed to the newsletter
        if ($oldValues->acc_nl=="da") {
            if ($this->accSendNewSubscribeValueToMj($oldValues, "nu")) {
                // code...
            }
        }

        // other code...

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("DELETE FROM `users` WHERE `ID`=:id_user");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);

            $r = $q->execute();
            $q = null;
            if ($r) {
                // no need for session messages
                // this should be done by a cronjob
                // or by a direct action of an admin

                if ($this->ID==$id_user) {
                    // logout if de delete action is done by the owner of the account
                    // this might be the case if it's decided to do a direct deletion
                    // by giving the option to skipp the "recovery posibile" stage
                    // or if it is decided to eliminate it completely
                    $this->doLogout();
                }
                return true;
            }
        }
        return false;
    }
    protected function accSendRecoveryLinkEmail( $params ) {

        $email = isset($params['email'])?$params['email']:"";
        $userObj = $this->getUserByEmail($email);
        if (!isset($userObj->ID)) {
            $_SESSION['msg_errors'][] = "Adresa e-mail inexistenta.";
            $this->rep['errors']['email'] = "is-invalid";
            return false;
        }

        $token_validare_email = $this->generateTokenValidareEmail();
        $link_activare_cont = BASE_URL.$this->buildUrl(array('view'=>'b_acc_recover_confirm', 'tra'=>$token_validare_email));
        $email = $userObj->email_user;
        $subject = "PLATFORM_NAME: "."Resetare parola";
        $name = $userObj->firstname_user." ".$userObj->lastname_user;
        $platform_name = "PLATFORM_NAME";
        $date = $userObj->delete_time;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, MJ_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('mode'=>"sendRecoverAccountEmail", 'link_activare_cont'=>$link_activare_cont, 'email'=>$email, 'subject'=>$subject, 'name'=>$name, 'platform_name'=>$platform_name, 'date'=>$date)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = json_decode(curl_exec($ch));

        curl_close ($ch);


        if ($server_output->success) {
            if ($this->accEditTokenValidareEmail($userObj->ID, $token_validare_email)) {
                # code...
            }
            $_SESSION['msg_success'][] = "A fost trimis un email cu linkul pentru recuperarea contului. Vă rugăm să urmăriți instrucțiunile din email pentru a recupera contul";
            return true;
        }else{
            $_SESSION['msg_errors'][] = "A apărut o eroare la trimiterea unui email cu linkul pentru recuperarea contului. Vă rugăm să încercați mai târziu.";
        }
        return false;
    }
    protected function accRecoveryConfirm( $token_validare_email ) {

        // user can be logged in without email confirmed (from older version)

        $checkUser = $this->getUserByTokenValidareEmail( $token_validare_email );
        if (!isset($checkUser->ID)) {
            $_SESSION['msg_warning'][] = 'Linkul este nu mai este valabil. Cere <a href="'.$this->buildUrl(array('view'=>'b_acc_recover')).'">aici</a> să fie retrimis emailul de recuperare a contului. În cazul în care ai recuperat deja contul, <a href="'.$this->buildUrl(array('view'=>"b_acc_login")).'">intră în cont</a>';
            $this->errflag = true;
        }elseif ($checkUser->status==-1) {
            // $_SESSION['msg_errors'][] = "Contul este sters.";

            // every other option will generate an error and eventualy return false
        }elseif ($checkUser->status==0) {
            $_SESSION['msg_errors'][] = "Contul este blocat.";
            $this->errflag = true;
        }elseif ($checkUser->status==2) {

            // peding admin action
            $_SESSION['msg_warning'][] = 'Adresa de email a fost confirmată. Un moderator va activa contul în curând.';
            $this->errflag = true;
        }else{
            // Covering other scenarios
            $_SESSION['msg_warning'][] = 'Covering other scenarios';
            $this->errflag = true;
        }

        if ($this->errflag) {
            return false;
        }

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                UPDATE `users` 
                SET 
                    `status`=3, 
                    `token_validare_email`=NULL, 
                    `modified_time`=NOW(), 
                    `delete_time`=NULL 
                WHERE 
                    `ID`=:ID
            ");
            $q->bindValue(":ID", $checkUser->ID, PDO::PARAM_INT);

            // status 3 because the user should be able to delete the account only when he is logged in

            $r = $q->execute();
            $q = null;
            if ($r) {

                $_SESSION['msg_success'][] = 'Contul a fost recuperat cu succes. <a href="'.$this->buildUrl(array('view'=>"b_acc_login")).'">Intră în cont</a>';

                return true;
            }
        }
        return false;
    }









    public function function_that_shortens_text_but_doesnt_cutoff_words($text, $length) {
        if(strlen($text) > $length) {
            $text = substr($text, 0, strpos($text, ' ', $length))."...";
        }
        return $text;
    }
    protected function f404Register( $id_user, $sursa, $slug ) {
        if ( $this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                INSERT INTO `hlp_404` 
                (
                    `created_time`, 
                    `sursa`, 
                    `id_user`, 
                    `slug`, 
                    `http_referer`, 
                    `request_uri`, 
                    `path_info`
                ) 
                VALUES 
                (
                    NOW(), 
                    :sursa, 
                    :id_user, 
                    :slug, 
                    :http_referer, 
                    :request_uri, 
                    :path_info
                )
            ");
            $q->bindValue(":sursa", $sursa, PDO::PARAM_STR);
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);
            $q->bindValue(":slug", $slug, PDO::PARAM_STR);
            $q->bindValue(":http_referer", isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'', PDO::PARAM_STR);
            $q->bindValue(":request_uri", isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'', PDO::PARAM_STR);
            $q->bindValue(":path_info", isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'', PDO::PARAM_STR);

            $q->execute();
            $r = $q->rowCount();
            $q = null;

            if ($r>0) {
                $id_insert = $this->db_connection->lastInsertId();
                return $id_insert;
            }else {
                #$_SESSION['msg_errors'][] = "Eroare la înregistrarea proiectului.";
            }
        }
        return false;
    }









    protected function deleteDirectory( $dir ) {
        // checks if file or dir exists
        if (!file_exists($dir)) {
            return true;
        }

        // checks if path given is not dir, then it deletes it
        if (!is_dir($dir)) {
            return unlink($dir);
        }

        // scandir($dir) = list of files in dir
        foreach (scandir($dir) as $item) {
            // skips up folder names
            if ($item == '.' || $item == '..') {
                continue;
            }

            // deleteDirectory on new item (maybe it's a folder again)
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }
    protected function listDirectoryFiles( $dir ) {
        $list = array();
        if (is_dir($dir)) {
            foreach (scandir($dir) as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }

                $list[] = $item;
            }
        }
        return $list;
    }









    protected function buildPager( $view, $nr_of_pages, $params ) {
        
        $nr_of_buttons = isset($params['nr_of_buttons'])?$params['nr_of_buttons']:5;
        $current_page = $this->page;
        $urlParams = $params;

        if ($nr_of_pages>$nr_of_buttons) {
            if ($current_page<=3) {
                $i_start = 1;
                $i_end = 5;
            }elseif ($current_page>=($nr_of_pages-3)) {
                $i_start = $nr_of_pages-4;
                $i_end = $nr_of_pages;
            }else{
                $i_start = $current_page-2;
                $i_end = $current_page+2;
            }
        }else{
            $i_start = 1;
            $i_end = $nr_of_pages;
        }


        $pager = "";
        if ($nr_of_pages>1) {
            $pager = '
                <div class="pager">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">';

            if ($current_page>1) {
                $urlParams['page'] = $current_page-1;
                $pager .= '
                            <li class="page-item prev">
                                <a class="page-link" href="'.$this->buildUrl($urlParams).'" aria-label="Previous">
                                    <span aria-hidden="true" class="icon-prev">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>';
            }else {
                $urlParams['page'] = 1;
                $pager .= '
                            <li class="page-item prev disabled">
                                <a class="page-link" href="'.$this->buildUrl($urlParams).'" aria-label="Previous">
                                    <span aria-hidden="true" class="icon-prev">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>';
            }
            for ($i=$i_start; $i<=$i_end ; $i++) {
                if ($i==$current_page) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $urlParams['page'] = $i;
                $pager .= ' <li class="page-item '.$active.'"><a class="page-link" href="'.$this->buildUrl($urlParams).'">'.$i.'</a></li>';
            }
            if ($current_page<$nr_of_pages) {
                $urlParams['page'] = $current_page+1;
                $pager .= '        <li class="page-item next">
                                        <a class="page-link" href="'.$this->buildUrl($urlParams).'" aria-label="Next">
                                            <span aria-hidden="true" class="icon-next">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>';
            }else {
                $urlParams['page'] = $nr_of_pages;
                $pager .= '        <li class="page-item next disabled">
                                        <a class="page-link" href="'.$this->buildUrl($urlParams).'" aria-label="Next">
                                            <span aria-hidden="true" class="icon-next">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>';
            }
            $pager .= '
                    </ul>
                </nav>
            </div>
            ';
        }
        return $pager;
    }
    protected function buildPagerAsTabs( $view, $nr_of_pages, $params ) {
        
        $nr_of_buttons = isset($params['nr_of_buttons'])?$params['nr_of_buttons']:5;
        $current_page = $this->page;
        $urlParams = $params;

        if ($nr_of_pages>$nr_of_buttons) {
            if ($current_page<=3) {
                $i_start = 1;
                $i_end = 5;
            }elseif ($current_page>=($nr_of_pages-3)) {
                $i_start = $nr_of_pages-4;
                $i_end = $nr_of_pages;
            }else{
                $i_start = $current_page-2;
                $i_end = $current_page+2;
            }
        }else{
            $i_start = 1;
            $i_end = $nr_of_pages;
        }


        $pager = "";
        if ($nr_of_pages>1) {
            $pager = '
                <div class="pager">
                    <nav aria-label="Page navigation">
                        <ul class="nav nav-pills justify-content-center">';

            if ($current_page>1) {
                $urlParams['page'] = $current_page-1;
                $pager .= '
                            <li class="nav-item prev">
                                <a class="page-link" href="'.$this->buildUrl($urlParams).'" aria-label="Previous">
                                    <span aria-hidden="true" class="icon-prev">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>';
            }else {
                $urlParams['page'] = 1;
                $pager .= '
                            <li class="nav-item prev disabled">
                                <a class="nav-link" href="'.$this->buildUrl($urlParams).'" aria-label="Previous">
                                    <span aria-hidden="true" class="icon-prev">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>';
            }
            for ($i=$i_start; $i<=$i_end ; $i++) {
                if ($i==$current_page) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $urlParams['page'] = $i;
                $pager .= ' <li class="nav-item"><a class="nav-link '.$active.'" href="'.$this->buildUrl($urlParams).'">'.$i.'</a></li>';
            }
            if ($current_page<$nr_of_pages) {
                $urlParams['page'] = $current_page+1;
                $pager .= '        <li class="nav-item next">
                                        <a class="nav-link" href="'.$this->buildUrl($urlParams).'" aria-label="Next">
                                            <span aria-hidden="true" class="icon-next">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>';
            }else {
                $urlParams['page'] = $nr_of_pages;
                $pager .= '        <li class="nav-item next disabled">
                                        <a class="nav-link" href="'.$this->buildUrl($urlParams).'" aria-label="Next">
                                            <span aria-hidden="true" class="icon-next">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>';
            }
            $pager .= '
                    </ul>
                </nav>
            </div>
            ';
        }
        return $pager;
    }
    public function buildUrl( $params ) {
        $view = isset($params['view'])?$params['view']:"";
        $lang = isset($params['lang'])?$params['lang']:"ro";

        switch ($view) {

            case 'a_index':
                $result = "/admin.php?view=".$view;
                break;
            case 'a_users_list':
                $result = "/admin.php?view=".$view."&status=".$params['status'];
                break;
            case 'a_files_agency_list':
                $result = "/admin.php?view=".$view;
                break;
            case 'a_files_clients_list':
                $result = "/admin.php?view=".$view;
                break;
            case 'a_files_clients_add':
                $result = "/admin.php?view=".$view;
                break;
            case 'a_files_clients_view':
                $result = "/admin.php?view=".$view."&id_file=".$params['id_file'];
                break;
            case 'a_files_folders_delete':
                $result = "/admin.php?view=".$view."&id_file=".$params['id_file'];
                break;
            case 'a_files_folders_edit':
                $result = "/admin.php?view=".$view."&id_file=".$params['id_file'];
                break;
            case 'a_files_folders_view':
                $result = "/admin.php?view=".$view."&id_file=".$params['id_file'];
                break;
            case 'a_files_folders_move':
                $result = "/admin.php?view=".$view."&id_file=".$params['id_file'];
                break;



            case 'b_acc_general':
                $result = "/contul-meu";
                $result = "/incarca.php?view=".$view;
                break;
            case 'b_acc_security':
                $result = "/contul-meu/setari";
                $result = "/incarca.php?view=".$view;
                break;
            case 'b_acc_password':
                $result = "/contul-meu/setari-siguranta";
                $result = "/incarca.php?view=".$view;
                break;
            case 'b_acc_password_request_reset':
                $result = "/contul-meu/reseteaza-parola";
                $result = "/incarca.php?view=".$view;
                break;
            case 'b_acc_password_set':
                $result = "/contul-meu/seteaza-parola/".$params['trp'];
                $result = "/incarca.php?view=".$view."&trp=".$params['trp'];
                break;
            case 'b_acc_login':
                $result = "/login";
                $result = "/incarca.php?view=".$view;
                break;
            case 'b_acc_logout':
                $result = "/logout";
                $result = "/incarca.php?view=".$view;
                break;
            case 'b_acc_register':
                $result = "/inregistrare";
                $result = "/incarca.php?view=".$view;
                break;
            case 'b_acc_register_success':
                $result = "/inregistrare-succes";
                $result = "/incarca.php?view=".$view;
                break;
            case 'b_acc_register_confirm':
                $result = "/inregistrare-confirmare/".$params['tve'];
                $result = "/incarca.php?view=".$view."&tve=".$params['tve'];
                break;
            case 'b_acc_recover':
                $result = "/incarca.php?view=".$view;
                break;
            case 'b_acc_recover_confirm':
                $result = "/incarca.php?view=".$view."&tra=".$params['tra'];
                break;
            case 'b_acc_profil':
                $result = "/incarca.php?view=b_acc_profil";
                $result = "/incarca.php?view=".$view;
                break;


            case 'f_404':
                $result = "/404";
                $result = "/incarca.php?view=".$view;
                break;

            case 'f_about':
                $result = ($lang=="ro")?"/despre":"/en/about";
                $result = "/incarca.php?view=".$view;
                break;
            case 'f_contact':
                $result = ($lang=="ro")?"/contact":"/en/contact";
                $result = "/incarca.php?view=".$view;
                break;
            case 'f_policy_cf':
                $result = ($lang=="ro")?"/politica-de-confidentialitate":"/en/privacy-policy";
                $result = "/incarca.php?view=".$view;
                break;
            case 'f_policy_ck':
                $result = ($lang=="ro")?"/politica-de-cookies":"/en/cookies-policy";
                $result = "/incarca.php?view=".$view;
                break;
            case 'f_policy_tc':
                $result = ($lang=="ro")?"/termeni-si-conditii":"/en/terms-and-conditions";
                $result = "/incarca.php?view=".$view;
                break;
            case 'f_services':
                $result = ($lang=="ro")?"/servicii":"/en/services";
                $result = "/incarca.php?view=".$view;
                break;

            
            case 'f_index':
                $result = ($lang=="ro")?"/":"/en/";
                $result = "/incarca.php?view=".$view;
                break;
            
            default:
                $result = "/";

                // during dev avoid redirecting to index
                $result = "/incarca.php?view=".$view;
                break;
        }
        return $result;
    }
    public function encodeEmail( $text ) {
        $output = "";
        for ($i = 0; $i < strlen($text); $i++) {
            $output .= '&#'.ord($text[$i]).';';
        }
        return $output;
    }
    public function slugify( $text ) {
        $diacritice = array(
            'à', 'á', 'å', 'ä', 'â', 'ă', 'ā', 'ą', 'ã', 'ə', 
            'æ', 
            'ß', 
            'ç', 'ć', 'č', '¢', 'ĉ', 
            'œ', 
            'đ', 'ď', 
            'ë', 'é', 'è', 'ě', 'ê', 'ē', 'ę', 'ė', 
            'ğ', 'ĝ', 'ģ', 
            'ĥ', 
            'i̇', 'í', 'ï', 'î', 'ī', 
            'ĵ', 
            'ķ', 
            'ļ', 'ł', 'ĺ', 'ľ',  
            'ņ', 'ń', 'ň', 'ñ', 
            'ö', 'ó', 'ò', 'ø', 'õ', 'ô', 'ő', 'ð', 'ơ', 
            'ř', 'ŗ', 'ŕ', 
            'ş', 'š', 'ŝ', 'ś', 'ș', 
            'ť', 'ț', 'ţ', 
            'þ', 
            'ü', 'ú', 'ů', 'ŭ', 'ù', 'û', 'ű', 'ū', 'ų', 'ư', 
            'ŵ', 
            'ý', 'ÿ', 'ŷ', 
            'ž', 'ż', 'ź', 
            'À', 'Á', 'Å', 'Ä', 'Â', 'Ă', 'Ā', 'Ą', 'Ã', 'Ə', 
            'Æ', 
            'SS', 
            'Ç', 'Ć', 'Č', '¢', 'Ĉ', 
            'Œ', 
            'Đ', 'Ď', 
            'Ë', 'É', 'È', 'Ě', 'Ê', 'Ē', 'Ę', 'Ė', 
            'Ğ', 'Ĝ', 'Ģ', 
            'Ĥ', 
            'İ', 'Í', 'Ï', 'Î', 'Ī', 
            'Ĵ', 
            'Ķ', 
            'Ļ', 'Ł', 'Ĺ', 'Ľ',  
            'Ņ', 'Ń', 'Ň', 'Ñ', 
            'Ö', 'Ó', 'Ò', 'Ø', 'Õ', 'Ô', 'Ő', 'Ð', 'Ơ', 
            'Ř', 'Ŗ', 'Ŕ', 
            'Ş', 'Š', 'Ŝ', 'Ś', 'Ș', 
            'Ť', 'Ț', 'Ţ', 
            'Þ', 
            'Ü', 'Ú', 'Ů', 'Ŭ', 'Ù', 'Û', 'Ű', 'Ū', 'Ų', 'Ư', 
            'Ŵ', 
            'Ý', 'Ÿ', 'Ŷ', 
            'Ž', 'Ż', 'Ź'
        );
        $transformat = array(
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 
            'ae', 
            'b', 
            'c', 'c', 'c', 'c', 'c', 
            'ce', 
            'd', 'd', 
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 
            'g', 'g', 'g', 
            'h', 
            'i', 'i', 'i', 'i', 'i', 
            'j', 
            'k', 
            'l', 'l', 'l', 'l',  
            'n', 'n', 'n', 'n', 
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 
            'r', 'r', 'r', 
            's', 's', 's', 's', 's', 
            't', 't', 't', 
            'th', 
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 
            'w', 
            'y', 'y', 'y', 
            'z', 'z', 'z', 
            'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 
            'AE', 
            'B', 
            'C', 'C', 'C', 'C', 'C', 
            'CE', 
            'D', 'D', 
            'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 
            'G', 'G', 'G', 
            'H', 
            'I', 'I', 'I', 'I', 'I', 
            'J', 
            'K', 
            'L', 'L', 'L', 'L',  
            'N', 'N', 'N', 'N', 
            'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 
            'R', 'R', 'R', 
            'S', 'S', 'S', 'S', 'S', 
            'T', 'T', 'T', 
            'TH', 
            'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 
            'W', 
            'Y', 'Y', 'Y', 
            'Z', 'Z', 'Z'
        );

        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');

        $text = trim($text);

        $text = str_replace($diacritice, $transformat, $text);

        $text = strtolower($text);

        $text = preg_replace('~[^\pL\d.]+~u', '-', $text);

        $text = preg_replace('~[^-\w.]+~', '', $text);

        $text = str_replace(".", "-", $text);

        $text = preg_replace('/(-)+/', '-', $text);

        $text = trim($text, '-');

        if (empty($text)) {
            return '';
        }
        return $text;
    }
    public function replaceDia( $text ) {
        $diacritice = array(
            'à', 'á', 'å', 'ä', 'â', 'ă', 'ā', 'ą', 'ã', 'ə', 
            'æ', 
            'ß', 
            'ç', 'ć', 'č', '¢', 'ĉ', 
            'œ', 
            'đ', 'ď', 
            'ë', 'é', 'è', 'ě', 'ê', 'ē', 'ę', 'ė', 
            'ğ', 'ĝ', 'ģ', 
            'ĥ', 
            'i̇', 'í', 'ï', 'î', 'ī', 
            'ĵ', 
            'ķ', 
            'ļ', 'ł', 'ĺ', 'ľ',  
            'ņ', 'ń', 'ň', 'ñ', 
            'ö', 'ó', 'ò', 'ø', 'õ', 'ô', 'ő', 'ð', 'ơ', 
            'ř', 'ŗ', 'ŕ', 
            'ş', 'š', 'ŝ', 'ś', 'ș', 
            'ť', 'ț', 'ţ', 
            'þ', 
            'ü', 'ú', 'ů', 'ŭ', 'ù', 'û', 'ű', 'ū', 'ų', 'ư', 
            'ŵ', 
            'ý', 'ÿ', 'ŷ', 
            'ž', 'ż', 'ź', 
            'À', 'Á', 'Å', 'Ä', 'Â', 'Ă', 'Ā', 'Ą', 'Ã', 'Ə', 
            'Æ', 
            'SS', 
            'Ç', 'Ć', 'Č', '¢', 'Ĉ', 
            'Œ', 
            'Đ', 'Ď', 
            'Ë', 'É', 'È', 'Ě', 'Ê', 'Ē', 'Ę', 'Ė', 
            'Ğ', 'Ĝ', 'Ģ', 
            'Ĥ', 
            'İ', 'Í', 'Ï', 'Î', 'Ī', 
            'Ĵ', 
            'Ķ', 
            'Ļ', 'Ł', 'Ĺ', 'Ľ',  
            'Ņ', 'Ń', 'Ň', 'Ñ', 
            'Ö', 'Ó', 'Ò', 'Ø', 'Õ', 'Ô', 'Ő', 'Ð', 'Ơ', 
            'Ř', 'Ŗ', 'Ŕ', 
            'Ş', 'Š', 'Ŝ', 'Ś', 'Ș', 
            'Ť', 'Ț', 'Ţ', 
            'Þ', 
            'Ü', 'Ú', 'Ů', 'Ŭ', 'Ù', 'Û', 'Ű', 'Ū', 'Ų', 'Ư', 
            'Ŵ', 
            'Ý', 'Ÿ', 'Ŷ', 
            'Ž', 'Ż', 'Ź'
        );
        $transformat = array(
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 
            'ae', 
            'b', 
            'c', 'c', 'c', 'c', 'c', 
            'ce', 
            'd', 'd', 
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 
            'g', 'g', 'g', 
            'h', 
            'i', 'i', 'i', 'i', 'i', 
            'j', 
            'k', 
            'l', 'l', 'l', 'l',  
            'n', 'n', 'n', 'n', 
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 
            'r', 'r', 'r', 
            's', 's', 's', 's', 's', 
            't', 't', 't', 
            'th', 
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 
            'w', 
            'y', 'y', 'y', 
            'z', 'z', 'z', 
            'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 
            'AE', 
            'B', 
            'C', 'C', 'C', 'C', 'C', 
            'CE', 
            'D', 'D', 
            'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 
            'G', 'G', 'G', 
            'H', 
            'I', 'I', 'I', 'I', 'I', 
            'J', 
            'K', 
            'L', 'L', 'L', 'L',  
            'N', 'N', 'N', 'N', 
            'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 
            'R', 'R', 'R', 
            'S', 'S', 'S', 'S', 'S', 
            'T', 'T', 'T', 
            'TH', 
            'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 
            'W', 
            'Y', 'Y', 'Y', 
            'Z', 'Z', 'Z'
        );

        #$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');

        #$text = trim($text);

        $text = str_replace($diacritice, $transformat, $text);

        $text = strtolower($text);

        if (empty($text)) {
            return '';
        }
        return $text;
    }










    protected function logAction( $params ) {
        $id_user = isset($params['id_user'])?$params['id_user']:null;
        $id_target = isset($params['id_target'])?$params['id_target']:null;
        $target_table = isset($params['target_table'])?$params['target_table']:"";
        $note = isset($params['note'])?$params['note']:"";

        if ($this->databaseConnection()) {

            $q = $this->db_connection->prepare("
                INSERT INTO `admin_log` 
                (
                    `id_user`, 
                    `id_target`, 
                    `target_table`, 
                    `note`, 
                    `created_time`
                ) 
                VALUES 
                (
                    :id_user, 
                    :id_target, 
                    :target_table, 
                    :note, 
                    NOW()
                )
            ");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_STR);
            $q->bindValue(":id_target", $id_target, PDO::PARAM_STR);
            $q->bindValue(":target_table", $target_table, PDO::PARAM_STR);
            $q->bindValue(":note", $note, PDO::PARAM_STR);

            $q->execute();
            $r = $q->rowCount();
            $q = null;
            if ($r>0) {
                
                $id_insert = $this->db_connection->lastInsertId();
                return $id_insert;
            }else{
                $_SESSION['msg_errors'][] = "Eroare la inregistrarea actiunii.";
                $_SESSION['msg_warning'][] = serialize($params);
            }
        }
        return false;
    }










    protected function filesGenerateFileView( $params ) {

        $hash = isset($params['hash'])?$params['hash']:"";

        // TODO: permissions
        // for now you have to be logged in
        if ($this->ID) {
            $fileObj = $this->filesGetObjByHash($hash);

            if (isset($fileObj->ID)) {
                // code...
                // var_dump($fileObj);

                if (is_file($fileObj->f_path)) {
                    // echo $fileObj->f_path . "<br>";
                    // echo $fileObj->mime . "<br>";

                    if (in_array($fileObj->mime, $this->types['img'])) {
                        header('Content-Type: ' . $fileObj->mime);
                        header('Connection: Keep-Alive');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($fileObj->f_path));
                        readfile($fileObj->f_path);
                    } else {
                        // code...
                        echo 'not image';
                    }
                    
                }else{
                    echo 'folder';
                }
            }else{
                // no file found

                echo 'no file found';
            }
        } else {
            $filePath = "images/placeholder-landscape.svg";
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $filePath);
            finfo_close($finfo);
            $size = filesize($filePath);



            header('Content-Type: ' . $mime);
            header('Connection: Keep-Alive');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . $size);
            readfile($filePath);
        }
        exit();
    }
    protected function filesGetObjById( $id_file ){
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    * 
                FROM `files` 
                WHERE 
                    `ID`=:id_file
            ");
            $q->bindValue(":id_file", $id_file, PDO::PARAM_INT);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function filesGetObjByHash( $hash ){
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    * 
                FROM `files` 
                WHERE 
                    `hash`=:hash
            ");
            $q->bindValue(":hash", $hash, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function filesGetObjSiblingByName( $name ){
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    * 
                FROM `files` 
                WHERE 
                    `name`=:name
            ");
            $q->bindValue(":name", $name, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function filesAddRemoveToFavorite( $params ) {
        $id_file = isset($params['id_file'])?$params['id_file']:null;
        $id_user = isset($params['id_user'])?$params['id_user']:null;


        $args = array();
        $args['id_user'] = $id_user;
        $args['target_table'] = "users_favorite_files";
        $args['id_target'] = $id_file;


        $fileObj = $this->filesGetObjById($id_file);
        if (!isset($fileObj->ID)) {
            $this->rep['ajxrsp'] = array('success'=>false, 'msg'=>"Eroare la identificarea fisierului/folderului.");
            $args['note'] = "Eroare la identificarea fisierului/folderului.";
            $this->logAction($args);
            return false;
        }
        if (empty($id_user)) {
            $this->rep['ajxrsp'] = array('success'=>false, 'msg'=>"Eroare la identificarea utilizatorului.");
            $args['note'] = "Eroare la identificarea utilizatorului.";
            $this->logAction($args);
            return false;
        }

        $checkFav = $this->filesCheckFavorite($params);
        if (isset($checkFav->ID)) {
            if ($this->filesRemoveFromFavorite($params)) {
                $this->rep['ajxrsp'] = array('success'=>true, 'msg'=>"Scos de la favorite", 'cls'=>"text-secondary");
                $args['note'] = "Scos de la favorite.";
                $this->logAction($args);
                return true;
            }else{
                $this->rep['ajxrsp'] = array('success'=>false, 'msg'=>"ERROR Scos de la favorite la favorite", 'cls'=>"text-danger");
                $args['note'] = "ERROR Scos de la favorite.";
                $this->logAction($args);
                return false;
            }
        }else {
            if ($this->filesAddToFavorite($params)) {
                $this->rep['ajxrsp'] = array('success'=>true, 'msg'=>"Adaugat la facorite", 'cls'=>"text-warning");
                $args['note'] = "Adaugat la facorite.";
                $this->logAction($args);
                return true;
            }else{
                $this->rep['ajxrsp'] = array('success'=>false, 'msg'=>"ERROR Adaugat la facorite", 'cls'=>"text-danger");
                $args['note'] = "ERROR Adaugat la facorite.";
                $this->logAction($args);
                return false;
            }
        }
        return false;
    }
    protected function filesCheckFavorite( $params ) {

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    * 
                FROM `users_favorite_files` 
                WHERE 
                    `id_user`=:id_user 
                    AND `id_file`=:id_file
            ");
            $q->bindValue(":id_user", $params['id_user'], PDO::PARAM_INT);
            $q->bindValue(":id_file", $params['id_file'], PDO::PARAM_INT);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function filesRemoveFromFavorite( $params ) {
        if ( $this->databaseConnection()) {

            $q = $this->db_connection->prepare("
                DELETE FROM `users_favorite_files` 
                WHERE 
                    `id_user`=:id_user 
                    AND `id_file`=:id_file
            ");
            $q->bindValue(":id_user", $params['id_user'], PDO::PARAM_INT);
            $q->bindValue(":id_file", $params['id_file'], PDO::PARAM_INT);
            $r = $q->execute();
            $q = null;

            if ($r) {
                return true;
            }
        }
        return false;
    }
    protected function filesAddToFavorite( $params ) {

        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                INSERT INTO `users_favorite_files` 
                (
                    `id_user`, 
                    `id_file`, 
                    `created_time`
                ) 
                VALUES 
                (
                    :id_user, 
                    :id_file, 
                    NOW()
                )
            ");
            $q->bindValue(":id_user", $params['id_user'], PDO::PARAM_INT);
            $q->bindValue(":id_file", $params['id_file'], PDO::PARAM_INT);

            $q->execute();
            $r = $q->rowCount();
            $q = null;
            if ($r>0) {
                return true;
            }
        }
        return false;
    }









    protected function newsletterAdaugaInscriereAjax( $params ) {
        $lastname = isset($params['lastname'])?$params['lastname']:'';
        $email = isset($params['email'])?$params['email']:'';
        $sursa = isset($params['sursa'])?$params['sursa']:'';

        if (
            empty($lastname)
            ||empty($email)
        ) {
            $this->rep['ajxrsp'] = array('success'=>false, 'msg'=>"Completați toate câmpurile sunt obligatorii.");
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->rep['ajxrsp'] = array('success'=>false, 'msg'=>"Vă rugăm să completați corect câmpul email.");
            return false;
        }

        if ($this->newsletterAdaugaInscriere($params)) {
            $this->rep['ajxrsp'] = array('success'=>true, 'msg'=>"Te-ai înscris cu succes la newsletter");
            return true;
        }
        $this->rep['ajxrsp'] = array('success'=>false, 'msg'=>"24213.");

        return false;
    }
    protected function newsletterAdaugaInscriere( $params ) {
        $lastname = isset($params['lastname'])?$params['lastname']:'';
        $email = isset($params['email'])?$params['email']:'';
        $sursa = isset($params['sursa'])?$params['sursa']:'';

        if ( $this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                INSERT INTO `hlp_newsletter` 
                (
                    `created_time`, 
                    `lastname`, 
                    `email`, 
                    `sursa`
                )
                VALUES 
                (
                    NOW(), 
                    AES_ENCRYPT(:lastname, :secretkey), 
                    AES_ENCRYPT(:email, :secretkey), 
                    :sursa
                )
            ");
            $q->bindValue(":lastname", $lastname, PDO::PARAM_STR);
            $q->bindValue(":email", $email, PDO::PARAM_STR);
            $q->bindValue(":sursa", $sursa, PDO::PARAM_STR);
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);

            $r = $q->execute();
            $q = null;

            if ($r) {
                return true;
            }
        }

        return false;
    }
    protected function setAdminLog( $tabel_modificat, $id_modificat, $descriere ) {

        if ( $this->databaseConnection() ) {
            $q = $this->db_connection->prepare("
                INSERT INTO `auc_admin_log` 
                (
                    `id_user`, 
                    `tabel_modificat`, 
                    `id_modificat`, 
                    `descriere`, 
                    `created_time`
                ) 
                VALUES 
                (
                    :id_user, 
                    :tabel_modificat, 
                    :id_modificat, 
                    :descriere, 
                    NOW()
                )
                ");
            $q->bindValue(":id_user", $this->ID, PDO::PARAM_INT);
            $q->bindValue(":tabel_modificat", $tabel_modificat, PDO::PARAM_STR);
            $q->bindValue(":id_modificat", $id_modificat, PDO::PARAM_INT);
            $q->bindValue(":descriere", $descriere, PDO::PARAM_STR);
            $q->execute();
            $r = $q->rowCount();

            if ($r>0) {

                return true;
            }else{

                $_SESSION['msg_errors'][] = 'Eroare LOG';
            }
        }
        return false;
    }
    protected function databaseConnection(){
        if ($this->db_connection != null) {
            return true;
        } else {
            try {
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $_SESSION['msg_errors'][] = MESSAGE_DATABASE_ERROR . $e->getMessage();
            }
        }
        return false;
    }
}