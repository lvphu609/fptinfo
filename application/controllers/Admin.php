<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public static $user_session;

    public static $dataJs = [
                    'jquery-2.1.3.min.js',
                    'jquery.md5.js',
                    'bootstrap.min.js',
                    'mod_login.js'
                ];
    public static $dataCss = [
                    'admin_page.css'
                ];

    public static $paging_limit = 10;

    public static $paging_ajax_limit = 5;
    

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('admin_model');
	    $this->load->library('session');
        static::$user_session = $this->session->userdata('user_login');
	}

    public function index(){
        $data['js_file'] = static::$dataJs;
        $data['css_file'] = static::$dataCss;

        if(empty(static::$user_session)){           
            $this->load->view('admin/login',$data);
        }else{
            $this->load->view('admin/pages/header',$data);
            $this->load->view('admin/pages/menu');
            $this->load->view('admin/pages/dashboard',$data);
            $this->load->view('admin/pages/footer');
        }
    }

    public function auth()
	{
        if(!empty(static::$user_session)) header('Location: '.base_url().'index.php/admin'); //logined

		$username = $this->input->post('username');
        // $remember = $this->input->post('remember');
        $password = $this->input->post('encrypt-password');
		
        $checkLogin = $this->admin_model->check_login($username,$password);

        if($checkLogin == false){
            $data['error'] = true;
            $data['js_file'] = static::$dataJs;
            $this->load->view('admin/login',$data);
        }else{
           redirect('admin');
        }
       
	}

    public function logout(){
        $this->session->sess_destroy();
        redirect('admin');
    }

    public function article_list(){
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');       

        //paging----
        $page = 1;

        if(isset($_GET['page'])){
          if(!empty($_GET['page'])&&$_GET['page']!=""&&$_GET['page']!=null&&  is_numeric($_GET['page'])){
            $page = intval($_GET['page']);
          }
        }
        if(isset($_POST['page'])){
          if(!empty($_POST['page'])&&$_POST['page']!=""&&$_POST['page']!=null&&  is_numeric($_POST['page'])){
            $page = intval($_POST['page']);
          }
        }        
        
        $this->load->library('fpt_paging');
        $config['base_url'] = base_url('index.php/admin/article_list?');
        $config['total_rows'] = $this->admin_model->countRecord('articles');
        $config['per_page'] = static::$paging_limit;
        $config['cur_page'] =$page;


        $this->fpt_paging->initialize($config);
        $pagination = $this->fpt_paging->create_links();
        //end paging---

        $data['article_list'] = $this->admin_model->articleList(static::$paging_limit,$page);
        $data['pagination'] = $pagination;
        $data['js_file'] = static::$dataJs;
        $data['css_file'] = static::$dataCss;
        $this->load->view('admin/pages/header',$data);
        $this->load->view('admin/pages/menu');
        $this->load->view('admin/pages/article_list',$data);
        $this->load->view('admin/pages/footer');
    }

    public function article_create(){
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');

        $data['js_file'] = static::$dataJs;
        $data['css_file'] = static::$dataCss;

        $this->load->view('admin/pages/header',$data);
        $this->load->view('admin/pages/menu');
        $this->load->view('admin/pages/article_create',$data);
        $this->load->view('admin/pages/footer');
    }

    public function article_store(){
        if(empty(static::$user_session)) return false;

        $input = $this->input->post(NULL, TRUE);

        $this->admin_model->storeArticle($input);

        // $message = "Luu thanh cong";

        header('Location: '.base_url().'index.php/admin/article_list');//?message='.urlencode($message));

    }

    public function del_article(){
        if(empty(static::$user_session)) return false;

        $id = $this->input->post('id');

        $isDelete = $this->admin_model->delArticle($id);

        $message = "";
        $status = "fail";
        if(!is_array($isDelete)){            
            $status = "success";
        }else{
            $message = '<div class="alert alert-warning" role="alert">
                        <strong>Cảnh báo!</strong>Không xóa được bài viết có tiêu đề <strong>'. $isDelete['title'] .'</strong>
                    </div>';
        }
        
        $result = array(
            'status' => $status,
            'result' => $id,
            'message' => $message
        );
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($result));
    }

    public function article_edit(){        
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');

        $id = $this->input->get('art');
        $data['article'] =  $this->admin_model->getFieldById('articles','id,title,content',$id);
        $data['css_file'] = static::$dataCss;
        $this->load->view('admin/pages/header',$data);
        $this->load->view('admin/pages/menu');
        $this->load->view('admin/pages/article_create',$data);
        $this->load->view('admin/pages/footer');
    }

    public function article_update(){
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');

        $input = $this->input->post(NULL, TRUE);

        $this->admin_model->updateArticle($input);

        header('Location: '.base_url().'index.php/admin/article_list');

    }

    public function filemanager(){
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');       

        $data['css_file'] = static::$dataCss;
        $this->load->view('admin/pages/header',$data);
        $this->load->view('admin/pages/menu');
        $this->load->view('admin/pages/filemanager',$data);
        $this->load->view('admin/pages/footer');
    }

    public function user(){
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');      

        $data['css_file'] = static::$dataCss;
        $this->load->view('admin/pages/header',$data);
        $this->load->view('admin/pages/menu');
        $this->load->view('admin/pages/user',$data);
        $this->load->view('admin/pages/footer');
    }

    public function chpass(){
        if(empty(static::$user_session)) return false;

        $input = $this->input->post(NULL, TRUE);

        $message = "";

        $alert = "alert-warning";

        $data['css_file'] = static::$dataCss;


        $old_pass = $input['old_pass'];
        $new_pass = $input['new_pass'];
        $re_new_pass = $input['re_new_pass'];

        if(trim($old_pass) == ""){
            $message = "Chưa nhập mật khẩu cũ.";
            
        }else{
            $old_pass_db = $this->admin_model->getFieldById('user','password',1);
            if(strcmp(md5(trim($old_pass)),$old_pass_db['password']) == 0){
                if(trim($new_pass) == ""){
                    $message = "Chưa nhập mật khẩu mới."; 
                    $data['old_pass'] = $old_pass;  
                }else if(strlen(trim($new_pass)) < 6){
                    $message = "Mật khẩu phải nhiều hơn hoặc bằng 6 ký tự."; 
                    $data['old_pass'] = $old_pass;
                }else if(trim($re_new_pass) == ""){
                    $message = "Nhập lại mật khẩu.";
                    $data['old_pass'] = $old_pass;
                    $data['new_pass'] = $new_pass;
                }else if(strcmp(trim($re_new_pass),$new_pass) != 0){
                    $message = "Mật khẩu mới và mật khẩu nhập lại không trùng khớp."; 
                    $data['old_pass'] = $old_pass;
                }else{
                    $isChangePass = $this->admin_model->userChangePass(trim($new_pass));
                    if($isChangePass){
                        $message = "Thay đổi mật khẩu thành công!";
                        $alert = "alert-success";    
                    }else{
                        $message = "Đã có lỗi xảy ra!";  
                    }                    
                }
            }else{
                $message = "Mật khẩu cũ nhập sai.";
                $alert = "alert-warning";
            }
        }

        $divMessage = '<div class="alert '.$alert.'" role="alert">'.
                          $message
                        .'</div>';

        $data['message'] = $divMessage;
        
        $this->load->view('admin/pages/header',$data);
        $this->load->view('admin/pages/menu');
        $this->load->view('admin/pages/user',$data);
        $this->load->view('admin/pages/footer');

    }

    public function menu(){
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');

        //paging----
        $page = 1;

        if(isset($_GET['page'])){
          if(!empty($_GET['page'])&&$_GET['page']!=""&&$_GET['page']!=null&&  is_numeric($_GET['page'])){
            $page = intval($_GET['page']);
          }
        }
        if(isset($_POST['page'])){
          if(!empty($_POST['page'])&&$_POST['page']!=""&&$_POST['page']!=null&&  is_numeric($_POST['page'])){
            $page = intval($_POST['page']);
          }
        }        
        
        $this->load->library('fpt_paging');
        $config['base_url'] = base_url('index.php/admin/menu?');
        $config['total_rows'] = $this->admin_model->countRecord('menu');
        $config['per_page'] = static::$paging_limit;
        $config['cur_page'] =$page;


        $this->fpt_paging->initialize($config);
        $pagination = $this->fpt_paging->create_links();
        //end paging---

        $data['menu_list'] = $this->admin_model->menuList(static::$paging_limit,$page);
        $data['pagination'] = $pagination;

        $data['css_file'] = static::$dataCss;
        $this->load->view('admin/pages/header',$data);
        $this->load->view('admin/pages/menu');
        $this->load->view('admin/pages/menu_list',$data);
        $this->load->view('admin/pages/footer');

    }

    public function menu_create(){
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');
        $data['css_file'] = static::$dataCss;
        $this->load->view('admin/pages/header',$data);
        $this->load->view('admin/pages/menu');
        $this->load->view('admin/pages/menu_create',$data);
        $this->load->view('admin/pages/footer');
    }

    public function menu_store(){
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');

        $input = $this->input->post(NULL, TRUE);

        $this->admin_model->storeMenu($input);

        header('Location: '.base_url().'index.php/admin/menu');

    }

    public function ajax_article_paging(){
        $page = $this->input->post('page');
        $numArticleRecord = $this->admin_model->countRecord('articles');

        $content = array(
          'list_article' => $this->admin_model->articleList(static::$paging_ajax_limit,$page)
        );

        $html = $this->load->view('admin/pages/list_article_paging', $content, true);

        $arr = array(
          'html' => $html,
          'totalField' => $numArticleRecord,
          'numFieldPerPage' => static::$paging_ajax_limit
        );
        $json = json_encode($arr);

        echo $json;
    }

    public function search_article(){
        $key = $this->input->post('key');
        $content = array(
           'list_article' => $this->admin_model->searchArticle($key)
        );
        $html = $this->load->view('admin/pages/list_article_paging', $content, true);

        echo $html;
    }

     public function menu_edit(){        
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');

        $id = $this->input->get('me');
        $data['menu'] =  $this->admin_model->getFieldById('menu','id,name,positions,article_id',$id);
        $data['css_file'] = static::$dataCss;
        $this->load->view('admin/pages/header',$data);
        $this->load->view('admin/pages/menu');
        $this->load->view('admin/pages/menu_create',$data);
        $this->load->view('admin/pages/footer');
    }

    public function menu_update(){
        if(empty(static::$user_session)) header('Location: '.base_url().'index.php/admin');

        $input = $this->input->post(NULL, TRUE);

        $this->admin_model->updateMenu($input);

        header('Location: '.base_url().'index.php/admin/menu');

    }

    public function del_menu(){
        if(empty(static::$user_session)) return false;

        $id = $this->input->post('id');

        $isDelete = $this->admin_model->delMenu($id);

        $message = "";
        $status = "fail";
        if(!is_array($isDelete)){            
            $status = "success";
        }else{
            $message = '<div class="alert alert-warning" role="alert">
                        <strong>Cảnh báo!</strong>Không xóa được menu <strong>'. $isDelete['name'] .'</strong>
                    </div>';
        }
        
        $result = array(
            'status' => $status,
            'result' => $id,
            'message' => $message
        );
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($result));
    }

}
