<?php
class AdminFunctions extends BaseFunctions
{

    public $version = "a1j";
    public $view = "a_index";
    public $breadCrumb = array();
    public $folderType = array('agencyfolder', 'client', 'brand', 'folder');

    public function __construct(){
        if (isset($_GET['view'])) {
            $this->view = trim(htmlspecialchars($_GET['view']));
        }

        if ($this->view=='b_acc_logout') {

            $args = array();
            $args['id_user'] = $this->ID;
            $args['target_table'] = "users";
            $args['id_target'] = $this->ID;
            $args['note'] = "User &ldquo;".$this->username."&rdquo; logged out. (admin)";
            $this->logAction($args);

            $this->doLogout();
            $this->redirect = $this->buildUrl(array('view'=>"f_index"));
        }elseif (isset($_COOKIE['rememberme'])) {

            $this->loginWithCookieData();
        }elseif (isset($_SESSION['id_user'])&&!empty($_SESSION['id_user'])&&$_SESSION['loggedin']==true) {

            $this->loginWithSessionData();
        }

        if (isset($_POST['folder_add'])) {

            $args = array();


            if (isset($_POST['f_name'])) {
                $args['f_name'] = trim(htmlspecialchars($_POST['f_name']));
            }else{
                $args['f_name'] = "";
            }
            if (isset($_POST['parent_id'])) {
                $args['parent_id'] = trim(htmlspecialchars($_POST['parent_id']));
            }else{
                $args['parent_id'] = "";
            }
            if (isset($_POST['type'])) {
                $args['type'] = trim(htmlspecialchars($_POST['type']));
            }else{
                $args['type'] = "";
            }

            if ($id_folder = $this->filesFolderAdd($args)) {
                // $this->redirect = $this->buildUrl(array('view'=>'a_files_folders_view', 'id_file'=>$args['parent_id']));
            }else{
                $this->rep['f_name'] = $args['f_name'];
            }
        }elseif (isset($_POST['folder_delete'])) {

            if (isset($_POST['id_folder'])) {
                $id_folder = trim(htmlspecialchars($_POST['id_folder']));
            }else{
                $id_folder = null;
            }

            $this->filesDeleteTree($id_folder, true);
        }elseif (isset($_POST['file_rename'])) {

            $args = array();
            if (isset($_POST['id_file'])) {
                $args['ID'] = trim(htmlspecialchars($_POST['id_file']));
            }else{
                $args['ID'] = null;
            }
            if (isset($_POST['f_name'])) {
                $args['name'] = trim(htmlspecialchars($_POST['f_name']));
            }else{
                $args['name'] = null;
            }

            if ($this->filesRemane($args, true)) {
                // code...
            }
        }elseif (isset($_POST['download_archive'])) {

            $args = array();
            if (isset($_POST['dl_list'])) {
                $args['dl_list'] = $_POST['dl_list'];
            }else{
                $args['dl_list'] = array();
            }
            if (isset($_POST['id_folder'])) {
                $args['id_folder'] = trim(htmlspecialchars($_POST['id_folder']));
            }else{
                $args['id_folder'] = null;
            }

            if ($this->filesArchiveStart($args)) {
                if ($args['id_folder']==-1) {
                    $this->redirect = $this->buildUrl(array('view'=>'a_files_agency_list'));
                }else{
                    $this->redirect = $this->buildUrl(array('view'=>'a_files_folders_view', 'id_file'=>$args['id_folder']));
                }
            }
        }elseif (isset($_POST['upload_files'])) {

            $args = array();
            if (isset($_FILES['formFile'])&&!empty($_FILES['formFile']['name'][0])) {
                $args['formFile'] = $_FILES['formFile'];
            }else{
                $args['formFile'] = null;
            }
            if (isset($_POST['id_folder'])) {
                $args['id_folder'] = trim(htmlspecialchars($_POST['id_folder']));
            }else{
                $args['id_folder'] = null;
            }

            if ($this->filesUploadMultipleFiles($args)) {
                // code...
            }
        }

        if ($this->view=="a_index") {

            $this->page_title = "Two & From - CMS";
            $this->page_description = "Atinge întregul potențial al organzației tale";

            $this->breadCrumb[] = array(
                'currentPage'=>true,
                'href'=>"#",
                'label'=>"Dashboard"
            );



            $this->rep['users']['nr'] = $this->usersGetNrByStatusGrouped(); // only one call to DB


            // multiple calls to DB
            // $this->rep['users']['nr']['total'] = $this->usersGetNrByStatus(array('status'=>"all"));
            // $this->rep['users']['nr']['approved'] = $this->usersGetNrByStatus(array('status'=>"3"));
            // $this->rep['users']['nr']['pending_approval'] = $this->usersGetNrByStatus(array('status'=>"2"));
            // $this->rep['users']['nr']['pending_confirmation'] = $this->usersGetNrByStatus(array('status'=>"1"));
            // $this->rep['users']['nr']['blocked'] = $this->usersGetNrByStatus(array('status'=>"0"));
            // $this->rep['users']['nr']['pending_deletion'] = $this->usersGetNrByStatus(array('status'=>"-1"));
        }elseif ($this->view=="a_users_list") {

            $this->dataTable = true;

            $args = array();

            if (isset($_GET['status'])) {
                $this->rep['status'] = $args['status'] = trim(htmlspecialchars($_GET['status']));
            }else{
                $this->rep['status'] = $args['status'] = "all";
            }

            $this->page_title = "Lista utilizatori";


            $this->breadCrumb[] = array(
                'currentPage'=>false,
                'href'=>$this->buildUrl(array('view'=>"a_index")),
                'label'=>"Dashboard"
            );
            $this->breadCrumb[] = array(
                'currentPage'=>true,
                'href'=>"#",
                'label'=>$this->page_title
            );
        }elseif ($this->view=="a_files_agency_list") {
            $this->lightbox = true;
            $this->fileUploader = true;

            $this->rep['favorite_file_ids'] = array();
            $favoriteFiles = $this->filesGetFavoriteFiles($this->ID);
            foreach ($favoriteFiles as $file) {
                $this->rep['favorite_file_ids'][] = $file['ID'];
            }

            $this->rep['list'] = array();
            $list = $this->filesGetListByType('agencyfolder');
            foreach ($list as $item) {
                if (in_array($item['type'], $this->folderType)) {
                    // code...
                    $item['nr_files'] = $this->filesGetFoldersChildrenDirectNumber($item['ID']);
                }
                $this->rep['list'][] = $item;
            }

            $this->page_title = "Lista foldere/fisiere agentie";
            $this->breadCrumb[] = array(
                'currentPage'=>false,
                'href'=>$this->buildUrl(array('view'=>"a_index")),
                'label'=>"Dashboard"
            );
            $this->breadCrumb[] = array(
                'currentPage'=>true,
                'href'=>"#",
                'label'=>$this->page_title
            );
        }elseif ($this->view=="a_files_clients_list") {

            $this->rep['favorite_file_ids'] = array();
            $favoriteFiles = $this->filesGetFavoriteFiles($this->ID);
            foreach ($favoriteFiles as $file) {
                $this->rep['favorite_file_ids'][] = $file['ID'];
            }

            $this->rep['clients_list'] = array();
            $clients_list = $this->filesGetListByType('client');
            foreach ($clients_list as $client) {
                $client['nr_files'] = $this->filesGetFoldersChildrenDirectNumber($client['ID']);
                $this->rep['clients_list'][] = $client;
            }

            $this->page_title = "Lista clienti";
            $this->breadCrumb[] = array(
                'currentPage'=>false,
                'href'=>$this->buildUrl(array('view'=>"a_index")),
                'label'=>"Dashboard"
            );
            $this->breadCrumb[] = array(
                'currentPage'=>true,
                'href'=>"#",
                'label'=>$this->page_title
            );
        }elseif ($this->view=="a_files_folders_edit") {

            $this->pageSel2 = true;
            $this->tinyMce = true;

            if (isset($_GET['id_file'])) {
                $id_file = trim(htmlspecialchars($_GET['id_file']));
            }else{
                $id_file = null;
            }

            $this->rep['folder'] = $this->filesGetObjById($id_file);
            if (isset($this->rep['folder']->ID)) {
                // $this->rep['folder']->children_list = array();
                // $children_list = $this->filesGetFoldersChildrenDirect($id_file);
                // foreach ($children_list as $item) {
                //     if ($item['type']=="folder"||$item['type']=="brand") {
                //         // code...
                //         $item['nr_files'] = $this->filesGetFoldersChildrenDirectNumber($item['ID']);
                //     }
                //     $this->rep['folder']->children_list[] = $item;
                // }

                $this->rep['parent'] = null;
                if (!empty($this->rep['folder']->parent_id)) {
                    $this->rep['parent'] = $this->filesGetObjById($this->rep['folder']->parent_id);
                }

                $this->page_title = $this->rep['folder']->name;
                $this->breadCrumb[] = array(
                    'currentPage'=>false,
                    'href'=>$this->buildUrl(array('view'=>"a_index")),
                    'label'=>"Dashboard"
                );
                $this->breadCrumb[] = array(
                    'currentPage'=>false,
                    'href'=>$this->buildUrl(array('view'=>"a_files_clients_list")),
                    'label'=>"Lista clienti"
                );
                $parents = $this->filesGetFoldersParentsAll($id_file);
                foreach ($parents as $key => $value) {
                    $this->breadCrumb[] = array(
                        'currentPage'=>false,
                        'href'=>$this->buildUrl(array('view'=>"a_files_folders_view", 'id_file'=>$value->ID)),
                        'label'=>$value->name
                    );
                }
                $this->breadCrumb[] = array(
                    'currentPage'=>true,
                    'href'=>"#",
                    'label'=>$this->page_title
                );
            }else{
                if (empty($this->redirect)) {
                    $this->redirect = $this->buildUrl(array('view'=>'a_files_clients_list'));
                }
            }
        }elseif ($this->view=="a_files_folders_view") {
            $this->lightbox = true;

            $this->rep['favorite_file_ids'] = array();
            $favoriteFiles = $this->filesGetFavoriteFiles($this->ID);
            foreach ($favoriteFiles as $file) {
                $this->rep['favorite_file_ids'][] = $file['ID'];
            }

            if (isset($_GET['id_file'])) {
                $id_file = trim(htmlspecialchars($_GET['id_file']));
            }else{
                $id_file = null;
            }
            if ($id_file==-1) {
                $this->redirect = $this->buildUrl(array('view'=>'a_files_agency_list'));
            }

            $this->rep['folder'] = $this->filesGetObjById($id_file);
            if (isset($this->rep['folder']->ID)) {
                
                if ($this->rep['folder']->type=="folder"||$this->rep['folder']->type=="agencyfolder") {
                    $this->fileUploader = true;
                }


                $this->rep['folder']->children_list = array();
                $children_list = $this->filesGetFoldersChildrenDirect($id_file);
                foreach ($children_list as $item) {
                    if (in_array($item['type'], $this->folderType)) {
                        // code...
                        $item['nr_files'] = $this->filesGetFoldersChildrenDirectNumber($item['ID']);
                    }
                    $this->rep['folder']->children_list[] = $item;
                }

                $this->page_title = $this->rep['folder']->name;
                $this->breadCrumb[] = array(
                    'currentPage'=>false,
                    'href'=>$this->buildUrl(array('view'=>"a_index")),
                    'label'=>"Dashboard"
                );

                if ($this->rep['folder']->parent_id==-1) {
                    $this->breadCrumb[] = array(
                        'currentPage'=>false,
                        'href'=>$this->buildUrl(array('view'=>"a_files_agency_list")),
                        'label'=>"Lista foldere/fisiere agentie"
                    );
                }else{
                    $this->breadCrumb[] = array(
                        'currentPage'=>false,
                        'href'=>$this->buildUrl(array('view'=>"a_files_clients_list")),
                        'label'=>"Lista clienti"
                    );
                }

                $parents = $this->filesGetFoldersParentsAll($id_file);
                foreach ($parents as $key => $value) {

                    if ($value->parent_id==-1) {
                        $this->breadCrumb[1] = array(
                            'currentPage'=>false,
                            'href'=>$this->buildUrl(array('view'=>"a_files_agency_list")),
                            'label'=>"Lista foldere/fisiere agentie"
                        );
                    }
                    $this->breadCrumb[] = array(
                        'currentPage'=>false,
                        'href'=>$this->buildUrl(array('view'=>"a_files_folders_view", 'id_file'=>$value->ID)),
                        'label'=>$value->name
                    );
                }
                $this->breadCrumb[] = array(
                    'currentPage'=>true,
                    'href'=>"#",
                    'label'=>$this->page_title
                );
            }else{
                if (empty($this->redirect)) {
                    $this->redirect = $this->buildUrl(array('view'=>'a_files_clients_list'));
                }
            }
        }elseif ($this->view=="a_files_folders_delete") {

            if (isset($_GET['id_file'])) {
                $id_file = trim(htmlspecialchars($_GET['id_file']));
            }else{
                $id_file = null;
            }

            $this->rep['folder'] = $this->filesGetObjById($id_file);
            if (isset($this->rep['folder']->ID)) {
                // code...
                $this->rep['children'] = $this->filesGetFoldersChildrenAll($id_file);
                $this->rep['children_view'] = $this->filesGenerateFolderTreeView($this->rep['children']);



                $this->page_title = $this->rep['folder']->name;
                $this->breadCrumb[] = array(
                    'currentPage'=>false,
                    'href'=>$this->buildUrl(array('view'=>"a_index")),
                    'label'=>"Dashboard"
                );
                $this->breadCrumb[] = array(
                    'currentPage'=>false,
                    'href'=>$this->buildUrl(array('view'=>"a_files_clients_list")),
                    'label'=>"Lista clienti"
                );


                $parents = $this->filesGetFoldersParentsAll($id_file);
                foreach ($parents as $key => $value) {
                    $this->breadCrumb[] = array(
                        'currentPage'=>false,
                        'href'=>$this->buildUrl(array('view'=>"a_files_folders_view", 'id_file'=>$value->ID)),
                        'label'=>$value->name
                    );
                }


                $this->breadCrumb[] = array(
                    'currentPage'=>false,
                    'href'=>$this->buildUrl(array('view'=>"a_files_folders_view", 'id_file'=>$id_file)),
                    'label'=>$this->page_title
                );
                $this->breadCrumb[] = array(
                    'currentPage'=>true,
                    'href'=>"#",
                    'label'=>'Sterge'
                );
            }else{
                if (empty($this->redirect)) {
                    $this->redirect = $this->buildUrl(array('view'=>'a_files_clients_list'));
                }
            }
        }elseif ($this->view=="a_files_folders_move") {

            if (isset($_GET['id_file'])) {
                $id_file = trim(htmlspecialchars($_GET['id_file']));
            }else{
                $id_file = null;
            }

            $this->rep['folder'] = $this->filesGetObjById($id_file);
            if (isset($this->rep['folder']->ID)) {
                // code...
                $this->rep['children'] = $this->filesGetFoldersChildrenAll();
                $this->rep['children_view'] = $this->filesGenerateFolderTreeMoveView($this->rep['children'], $this->rep['folder']);



                $this->page_title = $this->rep['folder']->name;
                $this->breadCrumb[] = array(
                    'currentPage'=>false,
                    'href'=>$this->buildUrl(array('view'=>"a_index")),
                    'label'=>"Dashboard"
                );
                $this->breadCrumb[] = array(
                    'currentPage'=>false,
                    'href'=>$this->buildUrl(array('view'=>"a_files_clients_list")),
                    'label'=>"Lista clienti"
                );
                $parents = $this->filesGetFoldersParentsAll($id_file);
                foreach ($parents as $key => $value) {
                    $this->breadCrumb[] = array(
                        'currentPage'=>false,
                        'href'=>$this->buildUrl(array('view'=>"a_files_folders_view", 'id_file'=>$value->ID)),
                        'label'=>$value->name
                    );
                }
                $this->breadCrumb[] = array(
                    'currentPage'=>false,
                    'href'=>$this->buildUrl(array('view'=>"a_files_folders_view", 'id_file'=>$id_file)),
                    'label'=>$this->page_title
                );
                $this->breadCrumb[] = array(
                    'currentPage'=>true,
                    'href'=>"#",
                    'label'=>'Sterge'
                );
            }else{
                if (empty($this->redirect)) {
                    $this->redirect = $this->buildUrl(array('view'=>'a_files_clients_list'));
                }
            }
        }elseif ($this->view=="uppy_folder") {

            $args = array();
            if (isset($_GET['id_folder'])) {
                $args['id_folder'] = trim(htmlspecialchars($_GET['id_folder']));
            }else{
                $args['id_folder'] = null;
            }
            if (isset($_FILES['my_file'])) {
                $args['my_file'] = $_FILES['my_file'];
            }else{
                $args['my_file'] = null;
            }

            if ($this->filesUploadFile($args)) {
                // code...
            }
        }
    }








    protected function usersGetNrByStatus( $params ) {
        $status = isset($params['status'])?$params['status']:"all";

        if ($status=="all") {
            $where = "1";
        }else{
            $where = "u.`status`=:status";
        }
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    COUNT(u.`ID`) AS nr 
                FROM `users` u 
                WHERE 
                    $where
            ");
            if ($status!="all") {
                $q->bindValue(":status", $status, PDO::PARAM_INT);
            }
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r->nr;
        }
        return false;
    }
    protected function usersGetNrByStatusGrouped() {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    COUNT(*) AS nr, 
                    `status`
                FROM `users` 
                WHERE 
                    1
                GROUP BY `status`
            ");
            $q->execute();
            $r = $q->fetchAll();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function usersGetByStatus( $params ) {
        $status = isset($params['status'])?$params['status']:"all";
        $nrOfRowsPerPage = isset($params['nrOfRowsPerPage'])?$params['nrOfRowsPerPage']:10;
        if ($status=="all") {
            $where = "1";
        }else{
            $where = "u.`status`=:status";
        }
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    u.*, 
                    AES_DECRYPT(u.`firstname`, :secretkey) AS firstname_user, 
                    AES_DECRYPT(u.`lastname`, :secretkey) AS lastname_user, 
                    AES_DECRYPT(u.`email`, :secretkey) AS email_user, 
                    AES_DECRYPT(u.`tel`, :secretkey) AS tel_user 
                FROM `users` u 
                WHERE 
                    $where
                ORDER BY 
                    u.`username` ASC
                LIMIT 0,:nrOfRowsPerPage
            ");
            $q->bindValue(":secretkey", DB_SECRET, PDO::PARAM_STR);
            $q->bindValue(":nrOfRowsPerPage", $nrOfRowsPerPage, PDO::PARAM_INT);
            if ($status!="all") {
                $q->bindValue(":status", $status, PDO::PARAM_INT);
            }
            $q->execute();
            $r = $q->fetchAll();
            $q = null;
            return $r;
        }
        return false;
    }








    protected function filesGetListByType( $type ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    f.* 
                FROM `files` f 
                LEFT JOIN `users_favorite_files` uff ON uff.`id_file`=f.`ID` AND uff.`id_user`=:id_user
                WHERE 
                    f.`type`=:type 
                ORDER BY 
                    uff.`id_user` DESC, 
                    f.`name` ASC
            ");
            $q->bindValue(":id_user", $this->ID, PDO::PARAM_INT);
            $q->bindValue(":type", $type, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchAll();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function filesGetObjByNameAndType( $name, $type ){
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    * 
                FROM `files` 
                WHERE 
                    `name`=:name 
                    AND `type`=:type
            ");
            $q->bindValue(":name", $name, PDO::PARAM_STR);
            $q->bindValue(":type", $type, PDO::PARAM_STR);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    // TODO: this one filesCheckSiblings( $params ) could replace filesGetObjByNameAndType( $name, $type )
    protected function filesCheckSiblings( $params ){
        $name = isset($params['name'])?$params['name']:"";
        $parent_id = isset($params['parent_id'])?$params['parent_id']:"";
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    * 
                FROM `files` 
                WHERE 
                    `name`=:name 
                    AND `parent_id`=:parent_id
            ");
            $q->bindValue(":name", $name, PDO::PARAM_STR);
            $q->bindValue(":parent_id", $parent_id, PDO::PARAM_INT);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function filesGetFoldersChildrenDirect( $id_file=null ){
        if ($this->databaseConnection()) {
            if (empty($id_file)) {
                $q = $this->db_connection->prepare("
                    SELECT 
                        f.* 
                    FROM `files` f 
                    LEFT JOIN `users_favorite_files` uff ON uff.`id_file`=f.`ID` AND uff.`id_user`=:id_user 
                    WHERE 
                        f.`parent_id` IS NULL 
                    ORDER BY 
                        uff.`id_user` DESC, 
                        f.`name` ASC
                ");
            } else {
                $q = $this->db_connection->prepare("
                    SELECT 
                        f.* 
                    FROM `files` f 
                    LEFT JOIN `users_favorite_files` uff ON uff.`id_file`=f.`ID` AND uff.`id_user`=:id_user 
                    WHERE 
                        f.`parent_id`=:id_file 
                    ORDER BY 
                        uff.`id_user` DESC, 
                        f.`name` ASC
                ");
                $q->bindValue(":id_file", $id_file, PDO::PARAM_INT);
            }
            $q->bindValue(":id_user", $this->ID, PDO::PARAM_INT);
            $q->execute();
            $r = $q->fetchAll();
            $q = null;
            return $r;
        }
        return false;
    }
    protected function filesGetFoldersChildrenAll( $id_file=null ){
        $results = array();

        $temp = $this->filesGetFoldersChildrenDirect($id_file);
        foreach ($temp as $child) {
            if ($child['type']!="file") {
                $child['children'] = $this->filesGetFoldersChildrenAll($child['ID']);
            }
            $results[] = $child;
        }
        return $results;
    }
    protected function filesGetFoldersParentsAll( $id_file ){
        $results = array();

        $checkFile = $this->filesGetObjById($id_file);
        if (isset($checkFile->ID)) {
            $parent_id = $checkFile->parent_id;

            while ($parent_id>0) {
                // code...
                $parent = $this->filesGetObjById($parent_id);
                $results[] = $parent;
                $parent_id = $parent->parent_id;
            }
        }
        return array_reverse($results);
    }
    protected function filesGetFoldersChildrenDirectNumber( $id_file ){
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    COUNT(*) AS nr 
                FROM `files` 
                WHERE 
                    `parent_id`=:id_file
            ");
            $q->bindValue(":id_file", $id_file, PDO::PARAM_INT);
            $q->execute();
            $r = $q->fetchObject();
            $q = null;
            return $r->nr;
        }
        return false;
    }
    protected function filesAgencyFolderAdd( $params ) {
        $name = isset($params['name'])?$params['name']:"";

        $type = "agencyfolder";
        $parent_path = "agency";
        $parent_id = -1;
        $mime = "";
        $size = 0;
        $note = "";

        if (empty($name)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Numele este obligatoriu.";
        }

        $hash = $this->filesGenerateHash();
        $slug = $this->slugify($name);

        $checkName = $this->filesGetObjByNameAndType($name, $type);
        if (isset($checkName->ID)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Numele este deja folosit.";
        }

        $f_path = $parent_path.'/'.$slug;
        $i = 0;
        while (is_dir($f_path)) {
            $i++;
            $f_path = $parent_path.'/'.$slug.'-'.$i;
        }
        if ($i>0) {
            $slug = $slug.'-'.$i;
        }


        if ($this->errflag) {
            return false;
        }


        $params['hash'] = $hash;
        $params['name'] = $name;
        $params['type'] = $type;
        $params['f_path'] = $f_path;
        $params['slug'] = $slug;
        $params['parent_path'] = $parent_path;
        $params['parent_id'] = $parent_id;
        $params['mime'] = $mime;
        $params['size'] = $size;
        $params['note'] = $note;


        if ($id_folder=$this->filesInsertDb($params)) {

            if (!$this->filesFolderCreate($params)) {
                return false;
            }
            return $id_folder;
        }
        return false;
    }
    protected function filesClientAdd( $params ) {
        $name = isset($params['name'])?$params['name']:"";

        $type = "client";
        $parent_path = "clienti";
        $parent_id = 0;
        $mime = "";
        $size = 0;
        $note = "";

        if (empty($name)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Numele este obligatoriu.";
        }

        $hash = $this->filesGenerateHash();
        $slug = $this->slugify($name);

        $checkName = $this->filesGetObjByNameAndType($name, $type);
        if (isset($checkName->ID)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Numele este deja folosit.";
        }

        $f_path = $parent_path.'/'.$slug;
        $i = 0;
        while (is_dir($f_path)) {
            $i++;
            $f_path = $parent_path.'/'.$slug.'-'.$i;
        }
        if ($i>0) {
            $slug = $slug.'-'.$i;
        }


        if ($this->errflag) {
            return false;
        }


        $params['hash'] = $hash;
        $params['name'] = $name;
        $params['type'] = $type;
        $params['f_path'] = $f_path;
        $params['slug'] = $slug;
        $params['parent_path'] = $parent_path;
        $params['parent_id'] = $parent_id;
        $params['mime'] = $mime;
        $params['size'] = $size;
        $params['note'] = $note;


        if ($id_client=$this->filesInsertDb($params)) {

            if (!$this->filesFolderCreate($params)) {
                return false;
            }
            
            $paramsAssetsClient = array();
            $paramsAssetsClient['name'] = "Upload de la client";
            $paramsAssetsClient['type'] = "folder";
            $paramsAssetsClient['hash'] = $this->filesGenerateHash();
            $paramsAssetsClient['f_path'] = $params['f_path']."/assets-client";
            $paramsAssetsClient['slug'] = "assets-client";
            $paramsAssetsClient['parent_path'] = $params['f_path'];
            $paramsAssetsClient['parent_id'] = $id_client;
            $paramsAssetsClient['note'] = "Folderul este disponibil pentru client pentru a incarca/descarca materiale";
            $id_assetsclient = $this->filesInsertDb($paramsAssetsClient);
            if (!$this->filesFolderCreate($paramsAssetsClient)) {
                $this->errflag = true;
            }
            
            $paramsBrand = array();
            $paramsBrand['name'] = "NUME_BRAND";
            $paramsBrand['parent_id'] = $id_client;
            if (!$this->filesBrandAdd($paramsBrand)) {
                $this->errflag = true;
            }

            if ($this->errflag) {
                $_SESSION['msg_warning'][] = "De sters ".$id_client;
                return false;
            }
            return $id_client;
        }
        return false;
    }
    protected function filesBrandAdd( $params ) {
        $name = isset($params['name'])?$params['name']:"";
        $parent_id = isset($params['parent_id'])?$params['parent_id']:null;

        $type = "brand";
        $mime = "";
        $size = 0;
        $note = "";

        if (empty($name)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Numele este obligatoriu.";
        }

        $parentObj = $this->filesGetObjById($parent_id);
        if (!isset($parentObj->ID)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Client neidentificat.";
        }
        $parent_path = $parentObj->f_path;

        $hash = $this->filesGenerateHash();
        $slug = $this->slugify($name);

        $checkName = $this->filesCheckSiblings($params);
        if (isset($checkName->ID)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Numele este deja folosit.";
        }

        $f_path = $parent_path.'/'.$slug;
        $i = 0;
        while (is_dir($f_path)) {
            $i++;
            $f_path = $parent_path.'/'.$slug.'-'.$i;
        }
        if ($i>0) {
            $slug = $slug.'-'.$i;
        }
        if ($i>0) {
            $_SESSION['msg_warning'][] = "Folderul &ldquo;".$parent_path.'/'.$slug."&rdquo exista deja, va fi fost creat folderul cu numele &ldquo;".$f_path."&rdquo;.";
        }


        if ($this->errflag) {
            return false;
        }


        $params['hash'] = $hash;
        $params['name'] = $name;
        $params['type'] = $type;
        $params['f_path'] = $f_path;
        $params['slug'] = $slug;
        $params['parent_path'] = $parent_path;
        $params['parent_id'] = $parent_id;
        $params['mime'] = $mime;
        $params['size'] = $size;
        $params['note'] = $note;


        if ($id_brand=$this->filesInsertDb($params)) {

            if (!$this->filesFolderCreate($params)) {
                return false;
            }

            $paramsAssetsBrand = array();
            $paramsAssetsBrand['name'] = "Assets Brand";
            $paramsAssetsBrand['type'] = "folder";
            $paramsAssetsBrand['hash'] = $this->filesGenerateHash();
            $paramsAssetsBrand['f_path'] = $params['f_path']."/assets-brand";
            $paramsAssetsBrand['slug'] = "assets-brand";
            $paramsAssetsBrand['parent_path'] = $params['f_path'];
            $paramsAssetsBrand['parent_id'] = $id_brand;
            $paramsAssetsBrand['note'] = "";
            $id_assetsbrand = $this->filesInsertDb($paramsAssetsBrand);
            if ($this->filesFolderCreate($paramsAssetsBrand)) {
                // code...
            }
            
            $paramsProiecte = array();
            $paramsProiecte['name'] = "Proiecte";
            $paramsProiecte['type'] = "folder";
            $paramsProiecte['hash'] = $this->filesGenerateHash();
            $paramsProiecte['f_path'] = $params['f_path']."/proiecte";
            $paramsProiecte['slug'] = "proiecte";
            $paramsProiecte['parent_path'] = $params['f_path'];
            $paramsProiecte['parent_id'] = $id_brand;
            $paramsProiecte['note'] = "Proiecte ||| Lorem ipsum";
            $id_proiecte = $this->filesInsertDb($paramsProiecte);
            if ($this->filesFolderCreate($paramsProiecte)) {
                $paramsData = array();
                $paramsData['name'] = date("Y");
                $paramsData['type'] = "folder";
                $paramsData['hash'] = $this->filesGenerateHash();
                $paramsData['f_path'] = $paramsProiecte['f_path']."/".$paramsData['name'];
                $paramsData['slug'] = $paramsData['name'];
                $paramsData['parent_path'] = $paramsProiecte['f_path'];
                $paramsData['parent_id'] = $id_proiecte;
                $paramsData['note'] = "";
                $id_data = $this->filesInsertDb($paramsData);
                if ($this->filesFolderCreate($paramsData)) {
                    $paramsWebsite = array();
                    $paramsWebsite['name'] = "Website";
                    $paramsWebsite['type'] = "folder";
                    $paramsWebsite['hash'] = $this->filesGenerateHash();
                    $paramsWebsite['f_path'] = $paramsData['f_path']."/website";
                    $paramsWebsite['slug'] = "website";
                    $paramsWebsite['parent_path'] = $paramsData['f_path'];
                    $paramsWebsite['parent_id'] = $id_data;
                    $paramsWebsite['note'] = "";
                    $id_website = $this->filesInsertDb($paramsWebsite);
                    if ($this->filesFolderCreate($paramsWebsite)) {
                        $paramsWebsiteMain = array();
                        $paramsWebsiteMain['name'] = "Main";
                        $paramsWebsiteMain['type'] = "folder";
                        $paramsWebsiteMain['hash'] = $this->filesGenerateHash();
                        $paramsWebsiteMain['f_path'] = $paramsWebsite['f_path']."/main";
                        $paramsWebsiteMain['slug'] = "main";
                        $paramsWebsiteMain['parent_path'] = $paramsWebsite['f_path'];
                        $paramsWebsiteMain['parent_id'] = $id_website;
                        $paramsWebsiteMain['note'] = "";
                        $id_websitemain = $this->filesInsertDb($paramsWebsiteMain);
                        if ($this->filesFolderCreate($paramsWebsiteMain)) {
                            // code...
                        }
                
                        $paramsWebsiteLP = array();
                        $paramsWebsiteLP['name'] = "LP-uri";
                        $paramsWebsiteLP['type'] = "folder";
                        $paramsWebsiteLP['hash'] = $this->filesGenerateHash();
                        $paramsWebsiteLP['f_path'] = $paramsWebsite['f_path']."/lp";
                        $paramsWebsiteLP['slug'] = "lp";
                        $paramsWebsiteLP['parent_path'] = $paramsWebsite['f_path'];
                        $paramsWebsiteLP['parent_id'] = $id_website;
                        $paramsWebsiteLP['note'] = "";
                        $id_websiteLP = $this->filesInsertDb($paramsWebsiteLP);
                        if ($this->filesFolderCreate($paramsWebsiteLP)) {
                            // code...
                        }
                    }

                    $paramsNumeProiect = array();
                    $paramsNumeProiect['name'] = "NUME_PROIECT_01";
                    $paramsNumeProiect['type'] = "folder";
                    $paramsNumeProiect['hash'] = $this->filesGenerateHash();
                    $paramsNumeProiect['f_path'] = $paramsData['f_path']."/nume-proiect";
                    $paramsNumeProiect['slug'] = "nume-proiect";
                    $paramsNumeProiect['parent_path'] = $paramsData['f_path'];
                    $paramsNumeProiect['parent_id'] = $id_data;
                    $paramsNumeProiect['note'] = "";
                    $id_numeproiect = $this->filesInsertDb($paramsNumeProiect);
                    if ($this->filesFolderCreate($paramsNumeProiect)) {
                        $paramsNumeProiectAssets = array();
                        $paramsNumeProiectAssets['name'] = "Assets";
                        $paramsNumeProiectAssets['type'] = "folder";
                        $paramsNumeProiectAssets['hash'] = $this->filesGenerateHash();
                        $paramsNumeProiectAssets['f_path'] = $paramsNumeProiect['f_path']."/assets";
                        $paramsNumeProiectAssets['slug'] = "assets";
                        $paramsNumeProiectAssets['parent_path'] = $paramsNumeProiect['f_path'];
                        $paramsNumeProiectAssets['parent_id'] = $id_numeproiect;
                        $paramsNumeProiectAssets['note'] = "";
                        $id_assetsproiect = $this->filesInsertDb($paramsNumeProiectAssets);
                        if ($this->filesFolderCreate($paramsNumeProiectAssets)) {
                            // code...
                        }
                
                        $paramsNumeProiectExports = array();
                        $paramsNumeProiectExports['name'] = "Exports";
                        $paramsNumeProiectExports['type'] = "folder";
                        $paramsNumeProiectExports['hash'] = $this->filesGenerateHash();
                        $paramsNumeProiectExports['f_path'] = $paramsNumeProiect['f_path']."/exports";
                        $paramsNumeProiectExports['slug'] = "exports";
                        $paramsNumeProiectExports['parent_path'] = $paramsNumeProiect['f_path'];
                        $paramsNumeProiectExports['parent_id'] = $id_numeproiect;
                        $paramsNumeProiectExports['note'] = "";
                        $id_exportsproiect = $this->filesInsertDb($paramsNumeProiectExports);
                        if ($this->filesFolderCreate($paramsNumeProiectExports)) {
                            // code...
                        }
                
                        $paramsNumeProiectCampanii = array();
                        $paramsNumeProiectCampanii['name'] = "Campanii";
                        $paramsNumeProiectCampanii['type'] = "folder";
                        $paramsNumeProiectCampanii['hash'] = $this->filesGenerateHash();
                        $paramsNumeProiectCampanii['f_path'] = $paramsNumeProiect['f_path']."/campanii";
                        $paramsNumeProiectCampanii['slug'] = "campanii";
                        $paramsNumeProiectCampanii['parent_path'] = $paramsNumeProiect['f_path'];
                        $paramsNumeProiectCampanii['parent_id'] = $id_numeproiect;
                        $paramsNumeProiectCampanii['note'] = "";
                        $id_campaniiproiect = $this->filesInsertDb($paramsNumeProiectCampanii);
                        if ($this->filesFolderCreate($paramsNumeProiectCampanii)) {
                            // code...
                        }
                    }
                }
            }

            return $id_brand;
        }
        return false;
    }
    protected function filesFolderAdd( $params ) {
        $args = array();
        $args['id_user'] = $this->ID;
        $args['target_table'] = "files";


        $name = isset($params['f_name'])?$params['f_name']:"";
        $params['name'] = $name;
        $parent_id = isset($params['parent_id'])?$params['parent_id']:null;
        $type = isset($params['type'])?$params['type']:"folder";

        $mime = "";
        $size = 0;
        $note = "";

        if ($type=="agencyfolder") {
            if ($id_folder = $this->filesAgencyFolderAdd($params)) {
                $this->redirect = $this->buildUrl(array('view'=>'a_files_agency_list'));
                $_SESSION['msg_success'][] = "Folderul a fost adaugat.";
                
                $args['id_target'] = $id_folder;
                $args['note'] = "Adaugat folderul &ldquo;".$name."&rdquo;.";
                $this->logAction($args);

                return true;
            }else{
                $_SESSION['msg_errors'][] = "Eroare la adaugarea clientului. ffa988";
                return false;
            }
        }elseif ($type=="client") {
            if ($id_folder = $this->filesClientAdd($params)) {
                $this->redirect = $this->buildUrl(array('view'=>'a_files_clients_list'));
                $_SESSION['msg_success'][] = "Clientul a fost adaugat.";
                
                $args['id_target'] = $id_folder;
                $args['note'] = "Adaugat clientul &ldquo;".$name."&rdquo;.";
                $this->logAction($args);

                return true;
            }else{
                $_SESSION['msg_errors'][] = "Eroare la adaugarea clientului. ffa988";
                return false;
            }
        }elseif ($type=="brand") {
            if ($id_folder = $this->filesBrandAdd($params)) {
                $this->redirect = $this->buildUrl(array('view'=>'a_files_folders_view', 'id_file'=>$parent_id));
                $_SESSION['msg_success'][] = "Brandul a fost adaugat.";
                
                $args['id_target'] = $id_folder;
                $args['note'] = "Adaugat brandul &ldquo;".$name."&rdquo;.";
                $this->logAction($args);

                return true;
            }else{
                $_SESSION['msg_errors'][] = "Eroare la adaugarea brandului. ffa997";
                return false;
            }
        }



        if (empty($name)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Numele este obligatoriu. ffa1006";
        }

        $parentObj = $this->filesGetObjById($parent_id);
        if (!isset($parentObj->ID)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Client neidentificat. ffa1012";
        }
        $parent_path = $parentObj->f_path;

        $hash = $this->filesGenerateHash();
        $slug = $this->slugify($name);

        $checkName = $this->filesCheckSiblings($params);
        if (isset($checkName->ID)) {
            $this->errflag = true;
            $_SESSION['msg_errors'][] = "Numele este deja folosit. ffa1022";
        }

        $f_path = $parent_path.'/'.$slug;
        $i = 0;
        while (is_dir($f_path)) {
            $i++;
            $f_path = $parent_path.'/'.$slug.'-'.$i;
        }
        if ($i>0) {
            $slug = $slug.'-'.$i;
            $_SESSION['msg_warning'][] = "Folderul &ldquo;".$parent_path.'/'.$slug."&rdquo exista deja, va fi fost creat folderul cu numele &ldquo;".$f_path."&rdquo;. ffa1032";
        }


        if ($this->errflag) {
            return false;
        }


        $params['hash'] = $hash;
        $params['name'] = $name;
        $params['type'] = $type;
        $params['f_path'] = $f_path;
        $params['slug'] = $slug;
        $params['parent_path'] = $parent_path;
        $params['parent_id'] = $parent_id;
        $params['mime'] = $mime;
        $params['size'] = $size;
        $params['note'] = $note;


        if ($id_folder=$this->filesInsertDb($params)) {

            if (!$this->filesFolderCreate($params)) {
                return false;
            }
            
            $args['id_target'] = $id_folder;
            $args['note'] = "Adaugat folderul &ldquo;".$name."&rdquo;.";
            $this->logAction($args);

            return $id_folder;
        }
        return false;
    }
    protected function filesGenerateHash() {
        $hash = sha1(uniqid(mt_rand(), true));
        $checkHash = $this->filesGetObjByHash($hash);
        if (isset($checkHash->ID)) {
            $hash = $this->filesGenerateHash();
        }
        return $hash;
    }
    protected function filesFolderCreate( $params ) {
        $f_path = isset($params['f_path'])?$params['f_path']:'';
        $name = isset($params['name'])?$params['name']:'';

        if (is_dir($f_path)) {
            $_SESSION['msg_errors'][] = "Folderul ".$name." (".$f_path.") exista deja.";
            return false;
        }

        $oldumask = umask(0);
        if (!mkdir($f_path, 0755)) {
            $_SESSION['msg_errors'][] = "Eroare la crearea folderului ".$name;
            return false;
        }
        umask($oldumask);
        return true;
    }
    protected function filesInsertDb( $params ) {
        // validate before calling
        $hash = isset($params['hash'])?$params['hash']:"";
        $name = isset($params['name'])?$params['name']:"";
        $type = isset($params['type'])?$params['type']:"";
        $f_path = isset($params['f_path'])?$params['f_path']:"";
        $slug = isset($params['slug'])?$params['slug']:"";
        $parent_path = isset($params['parent_path'])?$params['parent_path']:"";
        $parent_id = isset($params['parent_id'])?$params['parent_id']:null;
        $mime = isset($params['mime'])?$params['mime']:"";
        $size = isset($params['size'])?$params['size']:0;
        $note = isset($params['note'])?$params['note']:"";

        if ($this->databaseConnection()) {

            $q = $this->db_connection->prepare("
                INSERT INTO `files` 
                (
                    `hash`, 
                    `created_time`, 
                    `name`, 
                    `type`, 
                    `f_path`, 
                    `slug`, 
                    `parent_path`, 
                    `parent_id`, 
                    `mime`, 
                    `size`, 
                    `note`
                ) 
                VALUES 
                (
                    :hash, 
                    NOW(), 
                    :name, 
                    :type, 
                    :f_path, 
                    :slug, 
                    :parent_path, 
                    :parent_id, 
                    :mime, 
                    :size, 
                    :note
                )
            ");
            $q->bindValue(":hash", $hash, PDO::PARAM_STR);
            $q->bindValue(":name", $name, PDO::PARAM_STR);
            $q->bindValue(":type", $type, PDO::PARAM_STR);
            $q->bindValue(":f_path", $f_path, PDO::PARAM_STR);
            $q->bindValue(":slug", $slug, PDO::PARAM_STR);
            $q->bindValue(":parent_path", $parent_path, PDO::PARAM_STR);
            $q->bindValue(":parent_id", $parent_id, PDO::PARAM_STR);
            $q->bindValue(":mime", $mime, PDO::PARAM_STR);
            $q->bindValue(":size", $size, PDO::PARAM_STR);
            $q->bindValue(":note", $note, PDO::PARAM_STR);

            $q->execute();
            $r = $q->rowCount();
            $q = null;
            if ($r>0) {
                
                $id_insert = $this->db_connection->lastInsertId();
                return $id_insert;
            }else{
                $_SESSION['msg_errors'][] = "Eroare la inregistrarea folderului ".$name;
            }
        }
        return false;
    }
    protected function filesEditDb( $params ) {
        $ID = isset($params['ID'])?$params['ID']:NULL;
        $name = isset($params['name'])?$params['name']:"";
        $f_path = isset($params['f_path'])?$params['f_path']:"";
        $parent_path = isset($params['parent_path'])?$params['parent_path']:"";
        $slug = isset($params['slug'])?$params['slug']:"";

        if ($this->databaseConnection()) {

            $q = $this->db_connection->prepare("
                UPDATE
                    `files`
                SET
                    `modified_time` = NOW(),
                    `name` = :name,
                    `f_path` = :f_path,
                    `parent_path` = :parent_path,
                    `slug` = :slug
                WHERE
                    `ID` = :ID
            ");
            $q->bindValue(":name", $name, PDO::PARAM_STR);
            $q->bindValue(":f_path", $f_path, PDO::PARAM_STR);
            $q->bindValue(":parent_path", $parent_path, PDO::PARAM_STR);
            $q->bindValue(":slug", $slug, PDO::PARAM_STR);
            $q->bindValue(":ID", $ID, PDO::PARAM_INT);

            $r = $q->execute();
            $q = null;
            if ($r) {
                return true;
            }else{
                $_SESSION['msg_errors'][] = "Eroare la modificarea folderului/fisierului ".$name;
            }
        }
        return false;
    }
    protected function filesDeleteDb( $id_file ) {

        if ($this->databaseConnection()) {

            $q = $this->db_connection->prepare("DELETE FROM `files` WHERE `ID`=:id_file");
            $q->bindValue(":id_file", $id_file, PDO::PARAM_INT);

            $r = $q->execute();
            $q = null;
            if ($r) {

                return true;
            }else{
                $_SESSION['msg_errors'][] = "Eroare la stergerea folderului ".$id_file;
            }
        }
        return false;
    }
    protected function filesDeleteTree( $id_file, $start=true ) {
        $args = array();
        $args['id_user'] = $this->ID;
        $args['target_table'] = "files";

        $checkFile = $this->filesGetObjById($id_file);
        if (isset($checkFile->ID)) {
            if (in_array($checkFile->type, $this->folderType)) {
                $children = $this->filesGetFoldersChildrenAll( $id_file );
                if ($children) {
                    foreach ($children as $child) {
                        $hasChildren = (isset($child['children'])&&!empty($child['children']))?true:false;
                        if ($hasChildren) {
                            if ($this->filesDeleteTree($child['ID'], false)) {
                                // code...
                            }
                        }else{

                            if ($this->filesDeleteDb($child['ID'])) {
                                $args['id_target'] = $child['ID'];
                                $args['note'] = "Deleted file &ldquo;".$child['name']."&rdquo; (".$child['ID'].").";
                                $this->logAction($args);
                            }else{
                                $_SESSION['msg_errors'][] = "Eroare la stergere: ".$child['ID'];
                            }
                            if (!$this->deleteDirectory($child['f_path'])) {
                                $_SESSION['msg_warning'][] = "Fisierul nu a fost sters. fdt1201";
                            }
                        }
                    }
                }

                if (!$this->filesDeleteDb($id_file)) {
                    $args['id_target'] = $id_file;
                    $args['note'] = "Deleted file &ldquo;".$checkFile->name."&rdquo; (".$id_file.").";
                    $this->logAction($args);
                }else{
                    $_SESSION['msg_errors'][] = "Eroare la stergere: ".$id_file;
                }
                if ($this->deleteDirectory($checkFile->f_path)) {
                    if ($start) {
                        $_SESSION['msg_success'][] = "Folderul a fost sters. ".$checkFile->name." ".$checkFile->f_path;
                        if (!empty($checkFile->parent_id)) {
                            $this->redirect = $this->buildUrl(array('view'=>"a_files_folders_view", 'id_file'=>$checkFile->parent_id));
                        } else {
                            // $this->redirect = $this->buildUrl(array('view'=>"a_files_clients_list"));
                        }
                    }
                    return true;
                }else{
                    $_SESSION['msg_warning'][] = "Fisierul nu a fost sters. fdt1118";
                }
            }else {
                if ($this->filesDeleteDb($id_file)) {

                    $args['id_target'] = $id_file;
                    $args['note'] = "Deleted file &ldquo;".$checkFile->name."&rdquo; (".$id_file.").";
                    $this->logAction($args);

                    if ($this->deleteDirectory($checkFile->f_path)) {
                        $this->deleteDirectory($checkFile->parent_path.'/thumb-'.$checkFile->slug);
                        if ($start) {
                            $_SESSION['msg_success'][] = "Fisierul a fost sters.";
                            $this->redirect = $this->buildUrl(array('view'=>"a_files_folders_view", 'id_file'=>$checkFile->parent_id));
                        }
                        return true;
                    }else{
                        $_SESSION['msg_warning'][] = "Fisierul nu a fost sters. fdt1087";
                    }
                }
            }
        }else{
            $_SESSION['msg_errors'][] = "Folderul/fisierul nu a fost gasit. fdt1122".$id_file;
        }

        return false;
    }
    protected function filesGenerateFolderTreeView( $children ) {
        $result = '<ol class="wtree">';
        $tempResult = '';
        foreach ($children as $key => $value) {
            $hasChildren = (isset($value['children'])&&!empty($value['children'])&&in_array($value['type'], $this->folderType))?true:false;
            $tempResult .= '<li>';
            $tempResult .= '<span class="'.($hasChildren?'tree-toggler':'').'"><svg class="pc-icon"><use xlink:href="#'.(in_array($value['type'], $this->folderType)?"custom-folder-open":"custom-document-text").'"></use></svg>'.$value['name'].'</span>';
            if ($hasChildren) {
                $tempResult .= $this->filesGenerateFolderTreeView( $value['children'] );
            }
            $tempResult .= '</li>';
        }
        if (empty($tempResult)) {
            $result = 'Nu sint foldere/fisiere in aceasta locatie';
        }else{
            $result .= $tempResult;
            $result .= '</ol>';
        }
        return $result;
    }
    protected function filesGenerateFolderTreeMoveView( $children, $folderObj ) {
        $result = '<ol class="wtree">';
        $tempResult = '';
        foreach ($children as $key => $value) {
            $hasChildren = (isset($value['children'])&&!empty($value['children'])&&in_array($value['type'], $this->folderType))?true:false;
            $tempResult .= '<li>';
            $tempResult .= '<span class="'.($hasChildren?'tree-toggler':'').($value['ID']==$folderObj->ID?' willmove':'').'"><svg class="pc-icon"><use xlink:href="#'.(in_array($value['type'], $this->folderType)?"custom-folder-open":"custom-document-text").'"></use></svg>'.$value['name'].'</span>';
            if ($hasChildren) {
                $tempResult .= $this->filesGenerateFolderTreeMoveView( $value['children'], $folderObj );
            }
            $tempResult .= '</li>';
        }
        if (empty($tempResult)) {
            $result = 'Nu sint foldere/fisiere in aceasta locatie';
        }else{
            $result .= $tempResult;
            $result .= '</ol>';
        }
        return $result;
    }
    protected function filesUploadMultipleFiles( $params ) {
        // validate before calling
        $id_folder = isset($params['id_folder'])?$params['id_folder']:null;
        $formFile = isset($params['formFile'])?$params['formFile']:null;

        $args = array();
        $args['id_user'] = $this->ID;
        $args['target_table'] = "files";


        $folderObj = $this->filesGetObjById($id_folder);
        $i = 0;
        if (isset($formFile['name'])) {
            foreach ($formFile['name'] as $key => $name) {
                $my_file = array();
                $my_file['name'] = $formFile['name'][$key];
                $my_file['type'] = $formFile['type'][$key];
                $my_file['tmp_name'] = $formFile['tmp_name'][$key];
                $my_file['error'] = $formFile['error'][$key];
                $my_file['size'] = $formFile['size'][$key];

                $params['my_file'] = $my_file;
                if ($this->filesUploadFile($params)) {
                    $i++;
                }
            }
        }

        $args['id_target'] = $id_folder;
        if ($id_folder==-1) {
            $folderName = "agency";
            $this->redirect = $this->buildUrl(array('view'=>"a_files_agency_list"));
        }else{
            $folderName = $folderObj->name;
            $this->redirect = $this->buildUrl(array('view'=>"a_files_folders_view", 'id_file'=>$id_folder));
        }
        $args['note'] = "Uploaded ".$i." file".($i>1?"s":"")." in &ldquo;".$folderName."&rdquo; folder.";

        
        $this->logAction($args);

        if ($i) {
            $_SESSION['msg_success'][] = "Uploaded ".$i." file".($i>1?"s":"")." in &ldquo;".$folderName."&rdquo; folder.";
        } else {
            $_SESSION['msg_errors'][] = "No files uploaded.";
        }
        

        return $i;
    }
    protected function filesUploadFile( $params ) {
        // validate before calling
        $id_folder = isset($params['id_folder'])?$params['id_folder']:null;
        $my_file = isset($params['my_file'])?$params['my_file']:null;

        $args = array();
        $args['id_user'] = $this->ID;
        $args['target_table'] = "files";

        if (!empty($my_file['name'])) {
            $folderObj = $this->filesGetObjById($id_folder);

            if ($folderObj->type=="folder"||$folderObj->type=="agencyfolder") {
                $folderPath = $parent_path = $folderObj->f_path;
                $parent_id = $id_folder;
                $tmpFilePath = $my_file['tmp_name'];
                $originalFileName = trim(htmlspecialchars($my_file['name']));
                $temp = explode(".", $originalFileName);
                $fileExtension = strtolower(end($temp));
                $name = trim(htmlspecialchars($originalFileName));
                $baseName = basename($name, ".".$fileExtension);

                $args['name'] = $name;
                $args['parent_id'] = $parent_id;

                $checkSibling = $this->filesCheckSiblings($args);
                $i = 0;
                while (isset($checkSibling->ID)) {
                    $i++;
                    $args['name'] = $baseName." - ".$i.".".$fileExtension;
                    $checkSibling = $this->filesCheckSiblings($args);
                }
                if ($i>0) {
                    $name = $args['name'];
                    $baseName = $baseName." - ".$i;
                }

                $slug = $this->slugify($baseName).".".$fileExtension;
                $f_path = $parent_path."/".$slug;

                $hash = $this->filesGenerateHash();

                $mime = $my_file['type'];
                $size = $my_file['size'];

                $params['hash'] = $hash;
                $params['name'] = $name;
                $params['type'] = $fileExtension;
                $params['f_path'] = $f_path;
                $params['parent_path'] = $parent_path;
                $params['parent_id'] = $parent_id;
                $params['mime'] = $mime;
                $params['size'] = $size;
                $params['slug'] = $slug;

                if (move_uploaded_file($tmpFilePath, $f_path )) {
                    if (in_array($fileExtension, $this->extensions['img'])) {
                        if ($this->filesGenerateThumbnail($params)) {
                            // code...
                        }
                    }

                    if ($id_file = $this->filesInsertDb($params)) {

                        $args['id_target'] = $id_file;
                        $args['note'] = "Uploaded file &ldquo;".$name."&rdquo; to &ldquo;".$parent_path."&rdquo; => &ldquo;".$f_path."&rdquo;.";
                        $this->logAction($args);

                        return true;
                    }
                }
            }
        }


        return false;
    }
    protected function filesGenerateThumbnail( $params ) {


        $textFile = "control.txt";
        // $txt = date("Y-m-d H:i:s")." Sync started";
        // file_put_contents($textFile, "$txt\n", FILE_APPEND);




        $fileExtension = isset($params['type'])?$params['type']:'';
        $f_path = isset($params['f_path'])?$params['f_path']:'';
        $slug = isset($params['slug'])?$params['slug']:'';
        $parent_path = isset($params['parent_path'])?$params['parent_path']:'';
        $mime = isset($params['mime'])?$params['mime']:'';
        $filePath = $parent_path.'/thumb-'.$slug;


        // $txt = date("Y-m-d H:i:s")." filePath: ".$filePath;
        // file_put_contents($textFile, "$txt\n", FILE_APPEND);

        $dst_x = $dst_y = $src_x = $src_y = 0;


        list($src_width, $src_height) = getimagesize($f_path);
        // $txt = date("Y-m-d H:i:s")." src_width: ".$src_width;
        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
        // $txt = date("Y-m-d H:i:s")." src_height: ".$src_height;
        // file_put_contents($textFile, "$txt\n", FILE_APPEND);


        $dst_width = $dst_height = 250;
        if ($src_width>$src_height) {
            // $txt = date("Y-m-d H:i:s")." src_width>src_height";
            // file_put_contents($textFile, "$txt\n", FILE_APPEND);
            if ($src_width>$dst_width) {
                $percent = $dst_width/$src_width;
                $dst_height = $src_height*$percent;
            }else{
                $dst_width = $src_width;
                $dst_height = $src_height;
            }

            // $txt = date("Y-m-d H:i:s")." dst_width: ".$dst_width;
            // file_put_contents($textFile, "$txt\n", FILE_APPEND);

            // $txt = date("Y-m-d H:i:s")." dst_height: ".$dst_height;
            // file_put_contents($textFile, "$txt\n", FILE_APPEND);
        }else{
            // $txt = date("Y-m-d H:i:s")." src_width<src_height";
            // file_put_contents($textFile, "$txt\n", FILE_APPEND);
            if ($src_height>$dst_height) {
                $percent = $dst_height/$src_height;
                $dst_width = $src_width*$percent;
            }else{
                $dst_width = $src_width;
                $dst_height = $src_height;
            }

            // $txt = date("Y-m-d H:i:s")." dst_width: ".$dst_width;
            // file_put_contents($textFile, "$txt\n", FILE_APPEND);

            // $txt = date("Y-m-d H:i:s")." dst_height: ".$dst_height;
            // file_put_contents($textFile, "$txt\n", FILE_APPEND);
        }

        $dst_image = @imagecreatetruecolor($dst_width, $dst_height);

        if ($dst_image) {
            // $txt = date("Y-m-d H:i:s")." dst_image OK";
            // file_put_contents($textFile, "$txt\n", FILE_APPEND);
            switch ($fileExtension) {
                case 'bmp':
                    $src_image = @imagecreatefrombmp($f_path);
                    if ($src_image) {
                        // $txt = date("Y-m-d H:i:s")." ".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                        imagecopyresized($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);
                        imagebmp($dst_image, $filePath);
                    }else{
                        // $txt = date("Y-m-d H:i:s")." !".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                    }
                    break;
                case 'jpg':
                    $src_image = @imagecreatefromjpeg($f_path);
                    if ($src_image) {
                        // $txt = date("Y-m-d H:i:s")." ".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                        imagecopyresized($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);
                        imagejpeg($dst_image, $filePath);
                    }else{
                        // $txt = date("Y-m-d H:i:s")." !".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                    }
                    break;
                case 'jpeg':
                    $src_image = @imagecreatefromjpeg($f_path);
                    if ($src_image) {
                        // $txt = date("Y-m-d H:i:s")." ".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                        imagecopyresized($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);
                        imagejpeg($dst_image, $filePath);
                    }else{
                        // $txt = date("Y-m-d H:i:s")." !".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                    }
                    break;
                case 'gif':
                    $src_image = @imagecreatefromgif($f_path);
                    if ($src_image) {
                        // $txt = date("Y-m-d H:i:s")." ".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                        imagecopyresized($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);
                        imagegif($dst_image, $filePath);
                    }else{
                        // $txt = date("Y-m-d H:i:s")." !".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                    }
                    break;
                case 'png':
                    $src_image = @imagecreatefrompng($f_path);
                    if ($src_image) {
                        // $txt = date("Y-m-d H:i:s")." ".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                        imagecopyresized($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);
                        imagepng($dst_image, $filePath);
                    }else{
                        // $txt = date("Y-m-d H:i:s")." !".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                    }
                    break;
                case 'webp':
                    $src_image = @imagecreatefromwebp($f_path);
                    if ($src_image) {
                        // $txt = date("Y-m-d H:i:s")." ".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                        imagecopyresized($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);
                        imagewebp($dst_image, $filePath);
                    }else{
                        // $txt = date("Y-m-d H:i:s")." !".$fileExtension;
                        // file_put_contents($textFile, "$txt\n", FILE_APPEND);
                    }
                    break;
                
                default:
                    // code...
                    break;
            }
            imagedestroy($dst_image);
        }else{
            // $txt = date("Y-m-d H:i:s")." dst_image !OK";
            // file_put_contents($textFile, "$txt\n", FILE_APPEND);
        }


        return true;
    }
    protected function filesRemane( $params, $sessmsg=false ) {
        $ID = isset($params['ID'])?$params['ID']:null;

        $args = array();
        $args['id_user'] = $this->ID;
        $args['target_table'] = "files";
        $args['id_target'] = $ID;

        $folderObj = $this->filesGetObjById($ID);

        if (isset($folderObj->ID)) {

            $name = isset($params['name'])?$params['name']:$folderObj->name;
            $slug = isset($params['slug'])?$params['slug']:$folderObj->slug;
            $f_path = isset($params['f_path'])?$params['f_path']:$folderObj->f_path;
            $parent_path = isset($params['parent_path'])?$params['parent_path']:$folderObj->parent_path;

            if ($name!=$folderObj->name) {
                if (in_array($folderObj->type, $this->folderType)) {
                    $children = $this->filesGetFoldersChildrenDirect($ID);

                    $slug = $this->slugify($name);

                    $f_path = $parent_path.'/'.$slug;
                    $i = 0;
                    while (is_dir($f_path)) {
                        $i++;
                        $f_path = $parent_path.'/'.$slug.'-'.$i;
                    }
                    if ($i>0) {
                        $slug = $slug.'-'.$i;
                        if ($sessmsg) {
                            $_SESSION['msg_warning'][] = "Folderul &ldquo;".$parent_path.'/'.$slug."&rdquo exista deja, va fi fost creat folderul cu numele &ldquo;".$f_path."&rdquo;. fr1515";
                        }
                    }
                    if (rename($folderObj->f_path, $f_path)) {
                        // rename de folder
                        $params['name'] = $name;
                        $params['f_path'] = $f_path;
                        $params['slug'] = $slug;
                        $params['parent_path'] = $parent_path;
                        if ($this->filesEditDb($params)) {

                            $args['note'] = "Renamed folder &ldquo;".$folderObj->name."&rdquo; to &ldquo;".$name."&rdquo;.";
                            $this->logAction($args);


                            if ($sessmsg) {
                                $_SESSION['msg_success'][] = "Folderul a fost modificat.";
                            }
                            if ($children) {
                                foreach ($children as $child) {
                                    $child['parent_path'] = $params['f_path'];
                                    $child['f_path'] = $params['f_path']."/".$child['slug'];
                                    $this->filesRemane($child, false);
                                }
                            }
                        }
                    }
                } else {
                    // rename the file
                    $params['name'] = $name;
                    $params['f_path'] = $f_path;
                    $params['slug'] = $slug;
                    $params['parent_path'] = $parent_path;

                    if ($this->filesEditDb( $params )) {

                        $args['note'] = "Renamed file &ldquo;".$folderObj->name."&rdquo; to &ldquo;".$name."&rdquo;.";
                        $this->logAction($args);

                        if ($sessmsg) {
                            $_SESSION['msg_success'][] = "Fisierul a fost modificat.";
                        }
                    }
                }
            }elseif($parent_path!=$folderObj->parent_path){
                if (in_array($folderObj->type, $this->folderType)) {
                    $children = $this->filesGetFoldersChildrenDirect($ID);

                    if ($this->filesEditDb( $params )) {

                        $args['note'] = "Renamed folder &ldquo;".$folderObj->f_path."&rdquo; to &ldquo;".$f_path."&rdquo;.";
                        $this->logAction($args);

                        if ($sessmsg) {
                            $_SESSION['msg_success'][] = "Folderul a fost modificat.";
                        }
                        if ($children) {
                            foreach ($children as $child) {
                                $child['parent_path'] = $f_path;
                                $child['f_path'] = $f_path."/".$child['slug'];
                                $this->filesRemane($child, false);
                            }
                        }
                    }
                } else {
                    // rename the parent_path and f_path

                    $args['note'] = "Renamed file &ldquo;".$folderObj->f_path."&rdquo; to &ldquo;".$f_path."&rdquo;.";
                    $this->logAction($args);

                    if ($this->filesEditDb( $params )) {
                        if ($sessmsg) {
                            $_SESSION['msg_success'][] = "Fisierul a fost modificat.";
                        }
                    }
                }
            }else{
                $_SESSION['msg_warning'][] = "Totul a ramas neschimbat. fr1592";
                return true;
            }
        }else {
            $_SESSION['msg_errors'][] = "Fisier/Folder neidentificat fr1596";
        }

        return false;
    }
    protected function filesArchiveStart( $params ) {
        $args = array();
        $args['id_user'] = $this->ID;
        $args['target_table'] = "files";

        $dl_list = isset($params['dl_list'])?$params['dl_list']:array();
        $id_folder = isset($params['id_folder'])?$params['id_folder']:null;

        $zipName = 'archive-'.date('YmdHis').'.zip';
        $zip = new ZipArchive();
        $zip->open($zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE);


        
        $this->rep['zip'] = array();

        if ($dl_list) {
            foreach ($dl_list as $selected_id) {
                $this->filesArchiveAddFile($selected_id);
            }
        }else{
            $_SESSION['msg_errors'][] = "Nu au fost selectate foldere/fisiere pentru download.";
        }

        if ($this->rep['zip']) {
            foreach ($this->rep['zip'] as $item) {
                if ($item['type']=='folder') {
                    // $zip->addEmptyDir($item['relativePath']);
                }elseif ($item['type']=='file') {
                    $zip->addFile($item['filePath'], $item['relativePath']);

                    $args['id_target'] = $item['ID'];
                    $args['note'] = "Adaugat fisierul &ldquo;".$item['filePath']."&rdquo; la arhiva &ldquo;".$zipName."&rdquo;.";
                    $this->logAction($args);
                }else {
                    // code...
                }
                
            }
        }


        $zip->close();


        $quoted = sprintf('"%s"', addcslashes(basename($zipName), '"\\'));
        $size   = filesize($zipName);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        // header("Content-Type: application/zip");
        header('Content-Disposition: attachment; filename=' . $quoted); 
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . $size);

        ob_clean();
        flush();
        if (readfile($zipName)){
            if (is_file($zipName)) {
                unlink($zipName);
            }
            $args['note'] = "Downloadat arhiva &ldquo;".$zipName."&rdquo;. (si sters)";
        }

        ignore_user_abort(true);
        if (connection_aborted()) {
            if (is_file($zipName)) {
                unlink($zipName);
            }
            $args['note'] = "Downlod intrerupt arhiva &ldquo;".$zipName."&rdquo;. (si sters)";
        }

        $args['id_target'] = null;
        $this->logAction($args);

        // return true;

        exit();
    }
    protected function filesArchiveAddFile( $selected_id ) {
        $fileObj = $this->filesGetObjById($selected_id);
        if (isset($fileObj->ID)) {
            // $filePath = $fileObj->f_path;
            // $relativePath = substr($filePath, 8); // 8 = strlen('clienti/')
            // $this->rep['zip'][] = "id: ".$selected_id.", filePath: ".$filePath.", relativePath: ".$relativePath;
            if (in_array($fileObj->type, $this->folderType)) {
                $filePath = $fileObj->f_path;

                if (strpos($filePath, 'agency/')===0) {
                    $relativePath = substr($filePath, 7); // 7 = strlen('agency/')
                } else {
                    $relativePath = substr($filePath, 8); // 8 = strlen('clienti/')
                }

                // $this->rep['zip'][] = "FOLDER id: ".$selected_id.", filePath: ".$filePath.", relativePath: ".$relativePath;
                $this->rep['zip'][] = array('ID'=>$selected_id, 'type'=>'folder', 'filePath'=>$filePath, 'relativePath'=>$relativePath);

                $children_list = $this->filesGetFoldersChildrenDirect($selected_id);
                foreach ($children_list as $child_id) {
                    $this->filesArchiveAddFile($child_id['ID']);
                }
            } else {
                $filePath = $fileObj->f_path;

                if (strpos($filePath, 'agency/')===0) {
                    $relativePath = substr($filePath, 7); // 7 = strlen('agency/')
                } else {
                    $relativePath = substr($filePath, 8); // 8 = strlen('clienti/')
                }
                // $_SESSION['msg_warning'][] = "FILE id: ".$selected_id.", filePath: ".$filePath.", relativePath: ".$relativePath;
                if (file_exists($filePath)) {
                    $this->rep['zip'][] = array('ID'=>$selected_id, 'type'=>'file', 'filePath'=>$filePath, 'relativePath'=>$relativePath);
                }
            }
        }else{
            $_SESSION['msg_errors'][] = "Eroare la identificarea fisierului/folderului.";
        }
        return false;
    }
    protected function filesGetFavoriteFiles( $id_user ) {
        if ($this->databaseConnection()) {
            $q = $this->db_connection->prepare("
                SELECT 
                    f.* 
                FROM `users_favorite_files` uff 
                LEFT JOIN `files` f ON f.`ID`=uff.`id_file` 
                WHERE 
                    uff.`id_user`=:id_user
            ");
            $q->bindValue(":id_user", $id_user, PDO::PARAM_INT);
            $q->execute();
            $r = $q->fetchAll();
            $q = null;
            return $r;
        }
        return false;
    }
}