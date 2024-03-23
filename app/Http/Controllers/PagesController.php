<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Media;
use App\Models\Pages;
use App\Models\Services;
use App\Models\Settings;
use App\Models\AllSites;
use App\Models\Teams;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use ZipArchive;

class PagesController extends Controller
{

    function index(){
        return view('welcome');
    }

    function HomePage(){
        $slug = 'home';
        $settings = Settings::first();
        $blogs = Blogs::get();
        $AllSiteSettings = AllSites::where('siteslug' , '=' , $settings->homepage)->first();
        $page = Pages::where('slug', '=', $slug)->where('siteslug', '=', $settings->homepage)->first();
        $latestArticles = Blogs::orderby('created_at' , 'desc')->limit(1)->get();
        $blogData = [
            'blogs' => $blogs,
            'latestArticles' => $latestArticles
        ];
        $data = [
            'all_site_settings' => $AllSiteSettings,
            'settings' => $settings,
            'blogData' => $blogData,
            'page' => $page
        ];
        if($page){
            return view('front.index' , $data );
        } else {
            return abort(404);
        }
    }

    function LoadPage($slug){
        $settings = Settings::first();
        $blogs = Blogs::get();
        $AllSiteSettings = AllSites::where('siteslug' , '=' , $settings->homepage)->first();
        $page = Pages::where('slug', '=', $slug)->where('siteslug' , '=' , $settings->homepage)->first();
        $latestArticles = Blogs::orderby('created_at' , 'desc')->limit(1)->get();
        $blogData = [
            'blogs' => $blogs,
            'latestArticles' => $latestArticles
        ];
        $data = [
            'all_site_settings' => $AllSiteSettings,
            'settings' => $settings,
            'blogData' => $blogData,
            'page' => $page
        ];
        if($page){
            return view('front.index' , $data );
        } else {
            return abort(404);
        }
    }

    function LoadMutiPage($siteslug , $slug){
        $settings = Settings::first();
        $blogs = Blogs::get();
        $AllSiteSettings = AllSites::where('siteslug' , '=' , $siteslug)->first();
        $page = Pages::where('slug', '=', $slug)->where('siteslug' , '=' , $siteslug)->first();
        $latestArticles = Blogs::orderby('created_at' , 'desc')->limit(1)->get();
        $blogData = [
            'blogs' => $blogs,
            'latestArticles' => $latestArticles
        ];
        $data = [
            'all_site_settings' => $AllSiteSettings,
            'settings' => $settings,
            'blogData' => $blogData,
            'page' => $page
        ];
        if($page){
            return view('front.index' , $data );
        } else {
            return abort(404);
        }
    }

    function Blogdetails($id){
        $settings = Settings::first();
        $blogs = Blogs::findOrFail($id);
        $page = Pages::where('slug', '=', $slug)->first();
        $latestArticles = Blogs::orderby('created_at' , 'desc')->limit(1)->get();
        $blogData = [
            'blogs' => $blogs,
            'latestArticles' => $latestArticles
        ];
        $data = [
            'settings' => $settings,
            'blogData' => $blogData,
            'page' => $page
        ];
        if($page){
            return view('front.index' , $data );
        } else {
            return abort(404);
        }
    }

    //Site Setting

    function Site_Settings(){
        $site_setting['siteSetting'] = Settings::get();
        $site_setting['PageTitle'] = 'Site Setting Dashboard';
        return view('admin.pages.SiteSettings.site_settings' , $site_setting);
    }
    function Create_Site_Settings(){
        $create_site_settings['AllSites'] = AllSites::get();
        $create_site_settings['PageTitle'] = 'SitePages Create Dashboard';
        return view('admin.pages.SiteSettings.add_new_settings' , $create_site_settings);
    }
    function Create_Site_Form(Request $request){
        $MediaFavicon = NULL;
        $MediaPreloaderName = NULL;
        $request->validate([
            'site_logo' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        if($request->site_logo){
            $Mediaextension = $request->site_logo->getClientOriginalExtension();
            $MediaFavicon = $request->site_logo->getClientOriginalName();
            $Mediatitle = pathinfo($MediaFavicon, PATHINFO_FILENAME);

            $Media = new Media();
            $Media->title = $Mediatitle;
            $Media->extension = $Mediaextension;
            $Media->path = $MediaFavicon;
            $Media->save();

            $request->site_logo->move(public_path('media_uploads') , $MediaFavicon);
        }

        if($request->site_preloader){
            $Mediaextension = $request->site_preloader->getClientOriginalExtension();
            $MediaPreloaderName = $request->site_preloader->getClientOriginalName();
            $Mediatitle = pathinfo($MediaPreloaderName, PATHINFO_FILENAME);

            $Media = new Media();
            $Media->title = $Mediatitle;
            $Media->extension = $Mediaextension;
            $Media->path = $MediaPreloaderName;
            $Media->save();

            $request->site_preloader->move(public_path('media_uploads') , $MediaPreloaderName);
        }
        $data = [
            'site-logo' => $MediaFavicon,
            'site-preloader' => $MediaPreloaderName,
            'preloader-enable' => $request->preloader_value
        ];
        $site_setting = new Settings();
        $site_setting->homepage = $request->AllSites;
        $site_setting->header_scripts = $request->header_scripts;
        $site_setting->footer_scripts = $request->footer_scripts;
        $site_setting->extras = json_encode($data);
        $site_setting->save();

        if (!$site_setting->id) {
            return redirect(route('Create_Site_Settings' , ['id' . '=' . $id]))->with("error", "Registration failed");
        }
        return redirect(route('Site_Settings'))->with("success", "Registered successfully");
        
    }
    function Update_Site_Settings($id){
        $site_setting['AllSites'] = AllSites::get();
        $site_setting['site_setting'] = Settings::find($id);
        $site_setting['PageTitle'] = 'Settings Update Form';
        return view('admin.pages.SiteSettings.site_settings_update' , $site_setting);
    }
    function Update_Site_Settings_New(Request $request , $id){

        $settings = Settings::first();

        $MediaFavicon = NULL;
        $MediaPreloaderName = NULL;

        $request->validate([
            'site_logo' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        if($request->site_logo){
            $Mediaextension = $request->site_logo->getClientOriginalExtension();
            $MediaFavicon = $request->site_logo->getClientOriginalName();
            $Mediatitle = pathinfo($MediaFavicon, PATHINFO_FILENAME);

            $Media = new Media();
            $Media->title = $Mediatitle;
            $Media->extension = $Mediaextension;
            $Media->path = $MediaFavicon;
            $Media->save();

            $request->site_logo->move(public_path('media_uploads') , $MediaFavicon);
        }

        if($request->site_preloader){
            $Mediaextension = $request->site_preloader->getClientOriginalExtension();
            $MediaPreloaderName = $request->site_preloader->getClientOriginalName();
            $Mediatitle = pathinfo($MediaPreloaderName, PATHINFO_FILENAME);

            $Media = new Media();
            $Media->title = $Mediatitle;
            $Media->extension = $Mediaextension;
            $Media->path = $MediaPreloaderName;
            $Media->save();

            $request->site_preloader->move(public_path('media_uploads') , $MediaPreloaderName);
        }

        $data = [
            'site-logo' => $MediaFavicon,
            'site-preloader' => $MediaPreloaderName,
            'preloader-enable' => $request->site_preloader_name
        ];
        $site_setting = Settings::findOrFail($id);
        $site_setting->homepage = $request->AllSites;
        $site_setting->header_scripts = $request->header_scripts;
        $site_setting->footer_scripts = $request->footer_scripts;
        $site_setting->extras = json_encode($data);
        $site_setting->save();

        if (!$site_setting->id) {
            return redirect(route('Create_Site_Settings' , ['id' . '=' . $id]))->with("error", "Registration failed");
        }
        return redirect(route('Site_Settings'))->with("success", "Registered successfully");

    }
    function Site_Setting_Delete($id){
        $site_setting = Settings::findOrFail($id);
        $site_setting->delete();
        return redirect()->route('Site_Settings')->with('success', 'User deleted successfully');
    }

    //Site Email Settings 

    function Site_Email_Settings(){
        $site_setting['siteSetting'] = json_decode(Settings::first()->nav_project_data);
        $site_setting['PageTitle'] = 'Site Email Dashboard';
        return view('admin.pages.SiteEmailSettings.site_email_settings' , $site_setting);
    }
    function Site_Email_Settings_Update(Request $request){
        $settings = Settings::first();
        $smtp_settings = [
            'mail_driver' => $request->mail_driver,
            'mail_mailer' => $request->mail_mailer,
            'mail_port' => $request->mail_port,
            'mail_encryption' => $request->mail_encryption,
            'mail_host' => $request->mail_host,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'mail_from_address' => $request->mail_from_address,
            'mail_from_name' => $request->mail_from_name
        ];
        $data = [
            'smtp_settings' => $smtp_settings
        ];
        $settings->nav_project_data = json_encode($data);
        $settings->save();

        if (!$settings) {
            return redirect(route('Site_Email_Settings'))->with("error", "Registration failed");
        }
        return redirect(route('Site_Email_Settings'))->with("success", "Registered successfully");
    }

    //Site DownloadsUploads Settings 

    function DownloadsUploads(){
        return view('admin.pages.DawnloadUploads.downloaduploads');
    }
    function DownloadsDB(){
        $filename = 'light_cms';
        $outpufilename = public_path($filename);
        $table = DB::select('SHOW TABLES');
        $handle = fopen($outpufilename , 'w');
        foreach($table as $table){
            $tableName = reset($table);
            fwrite($handle, "-- Table structure for table `$tableName`" . PHP_EOL);
            fwrite($handle, DB::select("select CREATE TABLE $tableName")[0]->{'Create Table'} . ";" .PHP_EOL . PHP_EOL);

            fwrite($handle, "-- Dumping data for table `$tableName`" . PHP_EOL);
            $tableData = DB::table($tableName)->get()->toArray();
            foreach($tableData as $row){
                fwrite($handle, $this->generateInsertStatement($tableName, (array) $row) . ";" . PHP_EOL);
            }            
            fwrite($handle,PHP_EOL);
        }
        fclose($handle);
        Storage::disk('public')->putFileAs('/', $outpufilename , $filename);
        return response()->download($outpufilename)->deleteFileAfterSend(true);
    }
    private function generateInsertStatement($table , $data){
        $columns = implode("`,`" , array_keys($data));
        $values = "`" .implode("`,`" , array_values($data)) . "`";
    }
    function DownloadsFile(){
        $zip = new ZipArchieve();
        $file = 'assets_flyfare';
        $filename = $file.".zip";
        if($zip->open(public_path($filename) , ZipArchieved::CREATE) === TRUE){
            $file = FILE::files(public_path($file));
            foreach($files as $files){
                $zip->addFile($file , basename($file));
            }
            $zip->close();
            return response()->download(public_path($filePath))->deleteFileAfterSend(true);
        }else{
            return "Failed to Download File";
        }
        return redirect()->back();
    }
    function UploadDB(Request $request){
        dd("upload db");
    }
    function UploadFile(Request $request){
        $zip = new ZipArchieved;
        if($zip->open($request->sql_file , ZipArchieved::CREATE)){
            $zip->extractTo(public_path());
            $zip->close();
        }
        return redirect()->back();
    }

    //AllSite page functionality

    function AllSitePages(){
        $site_pages['site_pages'] = AllSites::get();
        $site_pages['PageTitle'] = 'All Site Dashboard';
        return view('admin.pages.allsites.allsites_pages' , $site_pages);
    }
    function Create_AllSite_Pages(){
        $create_site_pages = 'Create Your Site';
        return view('admin.pages.allsites.create_allsites_pages' , [ 'PageTitle' => $create_site_pages]);
    }
    function AllSite_Pages_Saver(Request $request){
        $AllSites = new AllSites();
        $AllSites->sitename = $request->sitename;
        $AllSites->siteslug = $request->siteslug;
        $AllSites->seo_title = $request->seo_title;
        $AllSites->meta_desc = $request->meta_desc;
        $AllSites->meta_tags = $request->meta_tags;
        $AllSites->header_scripts = $request->header_scripts;
        $AllSites->site_header = $request->site_header;
        $AllSites->site_footer = $request->site_footer;
        $AllSites->footer_scripts = $request->footer_scripts;
        $AllSites->site_css = $request->site_css;
        $AllSites->extras = json_encode($request->extras);
        $AllSites->save();

        if (!$AllSites->id) {
            return redirect(route('Create_AllSite_Pages'))->with("error", "Registration failed");
        }
        return redirect(route('AllSitePages'))->with("success", "Registered successfully");
    }
    function AllSite_Update($id){
        $AllSites['AllSites'] = AllSites::find($id);
        $AllSites['PageTitle'] = 'All Site Update Dashboard';
        return view('admin.pages.allsites.update_allsite_page' , $AllSites);
    }
    function AllSite_Update_saver(Request $request , $id){
        $AllSites = AllSites::findOrFail($id);
        $AllSites->sitename = $request->sitename;
        $AllSites->siteslug = $request->siteslug;
        $AllSites->seo_title = $request->seo_title;
        $AllSites->meta_desc = $request->meta_desc;
        $AllSites->meta_tags = $request->meta_tags;
        $AllSites->header_scripts = $request->header_scripts;
        $AllSites->site_header = $request->site_header;
        $AllSites->site_footer = $request->site_footer;
        $AllSites->footer_scripts = $request->footer_scripts;
        $AllSites->site_css = $request->site_css;
        $AllSites->extras = json_encode($request->extras);
        $AllSites->save();

        if (!$AllSites->id) {
            return redirect(route('Create_AllSite_Pages' , ['id' . '=' . $id]))->with("error", "Registration failed");
        }
        return redirect(route('AllSitePages'))->with("success", "Registered successfully");
    }
    function AllSite_Pages_Delete($id){
        $AllSites = AllSites::findOrFail($id);
        $AllSites->delete();
        return redirect()->route('AllSitePages')->with('success', 'User deleted successfully');
    }

    //Site page functionality

    function SitePages(){
        $site_pages['site_pages'] = Pages::get();
        $site_pages['PageTitle'] = 'SitePages Dashboard';
        return view('admin.pages.sites.site_pages' , $site_pages);
    }
    function Create_Site_Pages(){
        $allsites = AllSites::get();
        $create_site_pages = 'SitePages Create Dashboard';
        return view('admin.pages.sites.create_site_pages' , [ 'PageTitle' => $create_site_pages , 'allsites' => $allsites ]);
    }
    function SitePagesDetails($id){
        $page['page'] = Pages::findOrFail($id);
        if($page){
            return view('front.index' , $page);
        } else {
            return abort(404);
        }
    }
    function Site_Pages_Saver(Request $request){

        $Pages = new Pages();
        $Pages->name = $request->name;
        $Pages->slug = $request->slug;
        $Pages->siteslug = $request->siteslug;
        $Pages->status = $request->status;
        $Pages->seo_title = $request->seo_title;
        $Pages->meta_desc = $request->meta_desc;
        $Pages->meta_tags = $request->meta_tags;
        $Pages->html = $request->html;
        $Pages->header_scripts = $request->header_scripts;
        $Pages->footer_scripts = $request->footer_scripts;
        $Pages->save();

        if (!$Pages->id) {
            return redirect(route('Create_SitePages'))->with("error", "Registration failed");
        }
        return redirect(route('SitePages'))->with("success", "Registered successfully");
    }
    function PagesUpdate($id){
        $allsites['allsites'] = AllSites::get();
        $Pages['Pages'] = Pages::find($id);
        $Pages['PageTitle'] = 'Pages Update Dashboard';
        return view('admin.pages.sites.update_site_pages' , $Pages , $allsites);
    }
    function Pages_Update_New(Request $request , $id){
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'seo_title' => '',
            'meta_desc' => '',
            'meta_tags' => '',
            'html' => 'required',
            'header_scripts' => '',
            'footer_scripts' => '',
        ]);

        $Pages = Pages::findOrFail($id);
        $Pages->name = $request->name;
        $Pages->slug = $request->slug;
        $Pages->siteslug = $request->siteslug;
        $Pages->status = $request->status;
        $Pages->seo_title = $request->seo_title;
        $Pages->meta_desc = $request->meta_desc;
        $Pages->meta_tags = $request->meta_tags;
        $Pages->html = $request->html;
        $Pages->header_scripts = $request->header_scripts;
        $Pages->footer_scripts = $request->footer_scripts;
        $Pages->save();

        if (!$Pages->id) {
            return redirect(route('PagesUpdate' , ['id' . '=' . $id]))->with("error", "Registration failed");
        }
        return redirect(route('SitePages'))->with("success", "Registered successfully");
    }
    function PagesDelete($id){
        $PagesDelete = Pages::findOrFail($id);
        $PagesDelete->delete();
        return redirect()->route('SitePages')->with('success', 'User deleted successfully');
    }

    //blogs page functionality

    function Blogs(){
        $blogs['blogs'] = Blogs::get();
        $blogs['PageTitle'] = 'Blogs Dashboard';
        return view('admin.pages.blogs.blogs' , $blogs);
    }
    function BlogsDetails($id){
        $blogs['blogs'] = Blogs::find($id);
        $blogs['PageTitle'] = 'Blogs Details';
        return view('admin.pages.blogs.blog_details' , $blogs);
    }
    function Create_Blogs(){
        $Create_blogs['AllSites'] = AllSites::get();
        $Create_blogs['PageTitle'] = 'Blogs Create Dashboard';
        return view('admin.pages.blogs.create_blogs_pages' , $Create_blogs);
    }
    function Blogs_Saver(Request $request){
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'title' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'seo_title' => 'required',
            'author' => 'required',
            'meta_desc' => 'required',
            'meta_tags' => '',
            'additional_tags' => '',
            'category' => '',
            'summernote' => '',
            'header_scripts' => '',
            'footer_scripts' => '',
        ]);

        $Mediaextension = $request->featured_img->getClientOriginalExtension();
        $Mediafilename = $request->featured_img->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        $request->featured_img->move(public_path('media_uploads') , $Mediafilename);

        $Blogs = new Blogs();
        $Blogs->featured_img = $Mediafilename;
        $Blogs->title = $request->title;
        $Blogs->slug = $request->slug;
        $Blogs->siteslug = $request->AllSites;
        $Blogs->status = $request->status;
        $Blogs->seo_title = $request->seo_title;
        $Blogs->author = $request->author;
        $Blogs->meta_desc = $request->meta_desc;
        $Blogs->meta_tags = $request->meta_tags;
        $Blogs->additional_tags = $request->additional_tags;
        $Blogs->category = $request->category;
        $Blogs->summernote = $request->summernote;
        $Blogs->header_scripts = $request->header_scripts;
        $Blogs->footer_scripts = $request->footer_scripts;
        $Blogs->save();

        if (!$Blogs->id) {
            return redirect(route('Create_blogs'))->with("error", "Registration failed");
        }
        return redirect(route('Blogs'))->with("success", "Registered successfully");
    }
    function BlogsUpdate($id){
        $blogs['AllSites'] = AllSites::get();
        $blogs['blogs'] = Blogs::find($id);
        $blogs['PageTitle'] = 'Teams Dashboard';
        return view('admin.pages.blogs.update_blogs' , $blogs);
    }
    function Blogs_Update_New(Request $request , $id){
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'title' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'seo_title' => 'required',
            'author' => 'required',
            'meta_desc' => 'required',
            'meta_tags' => '',
            'additional_tags' => '',
            'category' => '',
            'summernote' => '',
            'header_scripts' => '',
            'footer_scripts' => '',
        ]);

        $Mediaextension = $request->featured_img->getClientOriginalExtension();
        $Mediafilename = $request->featured_img->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        $image_name = time().'.'.$request->featured_img->extension();
        $request->featured_img->move(public_path('media_uploads') , $image_name);

        $Blogs = Blogs::findOrFail($id);
        $Blogs->featured_img = $image_name;
        $Blogs->title = $request->title;
        $Blogs->slug = $request->slug;
        $Blogs->siteslug = $request->AllSites;
        $Blogs->status = $request->status;
        $Blogs->seo_title = $request->seo_title;
        $Blogs->author = $request->author;
        $Blogs->meta_desc = $request->meta_desc;
        $Blogs->meta_tags = $request->meta_tags;
        $Blogs->additional_tags = $request->additional_tags;
        $Blogs->category = $request->category;
        $Blogs->summernote = $request->summernote;
        $Blogs->header_scripts = $request->header_scripts;
        $Blogs->footer_scripts = $request->footer_scripts;
        $Blogs->save();

        if (!$Blogs->id) {
            return redirect(route('BlogsUpdate' , ['id' . '=' . $id]))->with("error", "Registration failed");
        }
        return redirect(route('Blogs'))->with("success", "Registered successfully");
    }
    function BlogDelete($id){

        $BlogsDelete = Blogs::findOrFail($id);

        if (Media::where('path' ,$BlogsDelete->featured_img )->exists()) {
            $MediaDelete = Media::where('path' ,$BlogsDelete->featured_img )->first();
            $filePath = public_path('media_uploads/' . $MediaDelete->path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $MediaDelete->delete();
        }

        $BlogsDelete->delete();
        return redirect()->route('Blogs')->with('success', 'User deleted successfully');

    }

    //Service page functionality

    function Services(){
        $services['services'] = Services::get();
        $services['PageTitle'] = 'Services Dashboard';
        return view('admin.pages.services.services' , $services);
    }
    function Services_Detail($id){
        $services['services'] = Services::find($id);
        $services['PageTitle'] = 'services Details';
        return view('admin.pages.services.services_details' , $services);
    }
    function Create_Services(){
        $Create_services['allsites'] = AllSites::get();
        $Create_services['PageTitle'] = 'Services Create Dashboard';
        return view('admin.pages.services.create_services' , $Create_services);
    }
    function Services_Saver(Request $request){
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'title' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'seo_title' => 'required',
            'author' => 'required',
            'meta_desc' => 'required',
            'meta_tags' => '',
            'additional_tags' => '',
            'category' => '',
            'summernote' => '',
            'header_scripts' => '',
            'footer_scripts' => '',
        ]);

        $Mediaextension = $request->featured_img->getClientOriginalExtension();
        $Mediafilename = $request->featured_img->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        $request->featured_img->move(public_path('media_uploads') , $Mediafilename);

        $Services = new Services();
        $Services->featured_img = $Mediafilename;
        $Services->title = $request->title;
        $Services->slug = $request->slug;
        $Services->siteslug = $request->siteslug;
        $Services->status = $request->status;
        $Services->seo_title = $request->seo_title;
        $Services->author = $request->author;
        $Services->meta_desc = $request->meta_desc;
        $Services->meta_tags = $request->meta_tags;
        $Services->additional_tags = $request->additional_tags;
        $Services->category = $request->category;
        $Services->summernote = $request->summernote;
        $Services->header_scripts = $request->header_scripts;
        $Services->footer_scripts = $request->footer_scripts;
        $Services->save();

        if (!$Services->id) {
            return redirect(route('Create_Services'))->with("error", "Registration failed");
        }
        return redirect(route('Services'))->with("success", "Registered successfully");
    }
    function Services_Update($id){
        $Services['allsites'] = AllSites::get();
        $Services['Services'] = Services::find($id);
        $Services['PageTitle'] = 'Teams Dashboard';
        return view('admin.pages.services.update_services' , $Services);
    }
    function Services_Update_New(Request $request , $id){
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'title' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'seo_title' => 'required',
            'author' => 'required',
            'meta_desc' => 'required',
            'meta_tags' => '',
            'additional_tags' => '',
            'category' => '',
            'summernote' => '',
            'header_scripts' => '',
            'footer_scripts' => '',
        ]);

        $Mediaextension = $request->featured_img->getClientOriginalExtension();
        $Mediafilename = $request->featured_img->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        $request->featured_img->move(public_path('media_uploads') , $Mediafilename);

        $Services = Services::findOrFail($id);
        $Services->featured_img = $Mediafilename;
        $Services->title = $request->title;
        $Services->slug = $request->slug;
        $Services->siteslug = $request->siteslug;
        $Services->status = $request->status;
        $Services->seo_title = $request->seo_title;
        $Services->author = $request->author;
        $Services->meta_desc = $request->meta_desc;
        $Services->meta_tags = $request->meta_tags;
        $Services->additional_tags = $request->additional_tags;
        $Services->category = $request->category;
        $Services->summernote = $request->summernote;
        $Services->header_scripts = $request->header_scripts;
        $Services->footer_scripts = $request->footer_scripts;
        $Services->save();

        if (!$Services->id) {
            return redirect(route('Services_Update' , ['id' . '=' . $id]))->with("error", "Registration failed");
        }
        return redirect(route('Services'))->with("success", "Registered successfully");
    }
    function Services_Delete($id){

        $ServicesDelete = Services::findOrFail($id);

        if (Media::where('path' ,$ServicesDelete->featured_img )->exists()) {
            $MediaDelete = Media::where('path' ,$ServicesDelete->featured_img )->first();
            $filePath = public_path('media_uploads/' . $MediaDelete->path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $MediaDelete->delete();
        }

        $ServicesDelete->delete();
        return redirect()->route('Services')->with('success', 'User deleted successfully');

    }

    //Team page functionality

    function Teams(){
        $teams['teams'] = Teams::get();
        $teams['PageTitle'] = 'Teams Dashboard';
        return view('admin.pages.teams.teams' , $teams);
    }
    function Teams_Detail($id){
        $teams['teams'] = Teams::find($id);
        $teams['PageTitle'] = 'Teams Details';
        return view('admin.pages.teams.teams_details' , $teams);
    }
    function Create_Teams(){
        $Create_teams['allsite'] = AllSites::get();
        $Create_teams['PageTitle'] = 'Teams Create Dashboard';
        return view('admin.pages.teams.create_teams' , $Create_teams);
    }
    function Teams_Saver(Request $request){
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'title' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'seo_title' => 'required',
            'author' => 'required',
            'meta_desc' => 'required',
            'meta_tags' => '',
            'additional_tags' => '',
            'category' => '',
            'summernote' => '',
            'header_scripts' => '',
            'footer_scripts' => '',
        ]);

        $Mediaextension = $request->featured_img->getClientOriginalExtension();
        $Mediafilename = $request->featured_img->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        $request->featured_img->move(public_path('media_uploads') , $Mediafilename);

        $Teams = new Teams();
        $Teams->featured_img = $Mediafilename;
        $Teams->title = $request->title;
        $Teams->slug = $request->slug;
        $Teams->siteslug = $request->siteslug;
        $Teams->status = $request->status;
        $Teams->seo_title = $request->seo_title;
        $Teams->author = $request->author;
        $Teams->meta_desc = $request->meta_desc;
        $Teams->meta_tags = $request->meta_tags;
        $Teams->additional_tags = $request->additional_tags;
        $Teams->category = $request->category;
        $Teams->summernote = $request->summernote;
        $Teams->header_scripts = $request->header_scripts;
        $Teams->footer_scripts = $request->footer_scripts;
        $Teams->save();

        if (!$Teams->id) {
            return redirect(route('Create_Teams'))->with("error", "Registration failed");
        }
        return redirect(route('Teams'))->with("success", "Registered successfully");
    }
    function Teams_Update($id){
        $teams['allsite'] = AllSites::get();
        $teams['teams'] = Teams::find($id);
        $teams['PageTitle'] = 'Teams Dashboard';
        return view('admin.pages.teams.update_team' , $teams);
    }
    function Teams_Update_New(Request $request , $id){
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'title' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'seo_title' => 'required',
            'author' => 'required',
            'meta_desc' => 'required',
            'meta_tags' => '',
            'additional_tags' => '',
            'category' => '',
            'summernote' => '',
            'header_scripts' => '',
            'footer_scripts' => '',
        ]);

        $Mediaextension = $request->featured_img->getClientOriginalExtension();
        $Mediafilename = $request->featured_img->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        $request->featured_img->move(public_path('media_uploads') , $Mediafilename);

        $Teams = Teams::findOrFail($id);
        $Teams->featured_img = $Mediafilename;
        $Teams->title = $request->title;
        $Teams->slug = $request->slug;
        $Teams->status = $request->status;
        $Teams->seo_title = $request->seo_title;
        $Teams->author = $request->author;
        $Teams->meta_desc = $request->meta_desc;
        $Teams->meta_tags = $request->meta_tags;
        $Teams->additional_tags = $request->additional_tags;
        $Teams->category = $request->category;
        $Teams->summernote = $request->summernote;
        $Teams->header_scripts = $request->header_scripts;
        $Teams->footer_scripts = $request->footer_scripts;
        $Teams->save();

        if (!$Teams->id) {
            return redirect(route('Teams_Update' , ['id' . '=' . $id]))->with("error", "Registration failed");
        }
        return redirect(route('Teams'))->with("success", "Registered successfully");
    }
    function Teams_Delete($id){
        $TeamsDelete = Teams::findOrFail($id);

        if (Media::where('path' ,$TeamsDelete->featured_img )->exists()) {
            $MediaDelete = Media::where('path' ,$TeamsDelete->featured_img )->first();
            $filePath = public_path('media_uploads/' . $MediaDelete->path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $MediaDelete->delete();
        }

        $TeamsDelete->delete();
        return redirect()->route('Teams')->with('success', 'User deleted successfully');

    }

    //Team page functionality

    function Email_Template(){
        $Email_template['Email_template'] = EmailTemplate::get();
        $Email_template['PageTitle'] = 'Email Template Dashboard';
        return view('admin.pages.EmailTemplate.email_template_view' , $Email_template);
    }
    function Email_Template_create(){
        $AllSites['allsites'] = AllSites::get();
        return view('admin.pages.EmailTemplate.email_templete_create' , $AllSites);
    }
    function Email_Template_Saver(Request $request){

        $EmailTemplate = new EmailTemplate();
        $EmailTemplate->name = $request->name;
        $EmailTemplate->siteslug = $request->siteslug;
        $EmailTemplate->html = $request->html;
        $EmailTemplate->extras = json_encode($request->extras);
        $EmailTemplate->save();

        if (!$EmailTemplate->id) {
            return redirect(route('Email_Template_create'))->with("error", "Registration failed");
        }
        return redirect(route('Email_Template'))->with("success", "Registered successfully");
    }
    function Email_Template_Update($id){
        $Email_template['allsites'] = AllSites::get();
        $Email_template['Email_template'] = EmailTemplate::find($id);
        $Email_template['PageTitle'] = 'Email Template Dashboard';
        return view('admin.pages.EmailTemplate.email_template_update' , $Email_template);
    }
    function Email_Template_Update_saver(Request $request , $id){
        $EmailTemplate = EmailTemplate::findOrFail($id);
        $EmailTemplate->name = $request->name;
        $EmailTemplate->siteslug = $request->siteslug;
        $EmailTemplate->html = $request->html;
        $EmailTemplate->extras = json_encode($request->extras);
        $EmailTemplate->save();

        if (!$EmailTemplate->id) {
            return redirect(route('Email_Template_create'))->with("error", "Registration failed");
        }
        return redirect(route('Email_Template'))->with("success", "Registered successfully");
    }
    function Email_Template_Delete($id){
        $EmailTemplate = EmailTemplate::findOrFail($id);
        $EmailTemplate->delete();
        return redirect()->route('Email_Template')->with('success', 'User deleted successfully');

    }

    //Media page functionality

    function Media(){
        $Media['media'] = Media::get();
        $Media['PageTitle'] = 'Teams Dashboard';
        return view('admin.pages.media.media' , $Media);
    }
    function Create_Media(){
        $Create_Media['PageTitle'] = 'Media Create Dashboard';
        return view('admin.pages.media.create_media' , $Create_Media);
    }
    function Media_Saver(Request $request){
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $extension = $request->featured_img->getClientOriginalExtension();
        $filename = $request->featured_img->getClientOriginalName();
        $title = pathinfo($filename, PATHINFO_FILENAME);
        $request->featured_img->move(public_path('media_uploads') , $filename);

        $Media = new Media();
        $Media->title = $title;
        $Media->extension = $extension;
        $Media->path = $filename;
        $Media->save();

        if (!$Media->id) {
            return redirect(route('Create_Media'))->with("error", "Registration failed");
        }
        return redirect(route('Media'))->with("success", "Registered successfully");
    }
    function Media_Delete($id){
        $MediaDelete = Media::findOrFail($id);
        $MediaDelete->delete();

        $file = "media_uploads/" . $MediaDelete->path;
        $filePath = public_path($file);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        return redirect()->route('Media')->with('success', 'User deleted successfully');
    }

}
