<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Media;
use App\Models\Pages;
use App\Models\Services;
use App\Models\Settings;
use App\Models\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{

    public function index(){
        return view('welcome');
    }

    public function HomePage(){

    }

    public function LoadPage($slug){
        $settings['settings'] = Settings::first();
        $blogs['blogs'] = Blogs::get();
        $page['pages'] = Pages::where('slug', '=', $slug)->first();
        $data = [
            'pages' => $page,
            'blogs' => $blogs
        ];
        if($page){
            return view('front.index' , $settings , $data );
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
        $create_site_settings['PageTitle'] = 'SitePages Create Dashboard';
        return view('admin.pages.SiteSettings.add_new_settings' , $create_site_settings);
    }
    function Create_Site_Form(Request $request){
        // dd("error");die();
        $request->validate([
            'site_logo' => '',
            'site_name' => 'required',
            'title' => 'required',
            'header_scripts' => '',
            'footer_scripts' => '',
            'nav_html' => '',
            'nav_css' => '',
            'nav_project_data' => '',
            'footer_html' => '',
        ]);
        // dd($request);

        $name = $request->site_logo->getClientOriginalName();
        $path = $request->site_logo->storeAs('/media_uploads', $name);

        $request->site_logo->move(public_path('media_uploads') , $name);

        $jsonString = "{\"favicon\" : \"$path\"}";
        // $jsonObject = json_decode($jsonString);

        $site_setting = new Settings();
        $site_setting->site_name = $request->site_name;
        $site_setting->title = $request->title;
        $site_setting->header_scripts = $request->header_scripts;
        $site_setting->footer_scripts = $request->footer_scripts;
        $site_setting->nav_html = $request->nav_html;
        $site_setting->nav_css = $request->nav_css;
        $site_setting->nav_project_data = $jsonString;
        $site_setting->footer_html = $request->footer_html;
        $site_setting->save();

        if (!$site_setting->id) {
            return redirect(route('Create_Site_Settings'))->with("error", "Registration failed");
        }
        return redirect(route('Site_Settings'))->with("success", "Registered successfully");
    }
    function Update_Site_Settings($id){
        $site_setting['site_setting'] = Settings::find($id);
        $site_setting['PageTitle'] = 'Settings Update Form';
        return view('admin.pages.SiteSettings.site_settings_update' , $site_setting);
    }
    function Update_Site_Settings_New(Request $request , $id){
        // dd("error");die();
        $request->validate([
            'site_logo' => '',
            'site_name' => 'required',
            'title' => 'required',
            'header_scripts' => '',
            'footer_scripts' => '',
            'nav_html' => '',
            'nav_css' => '',
            'nav_project_data' => '',
            'footer_html' => '',
        ]);
        // dd($request);

        // $image_name = time().'.'.$request->featured_img->extension();
        // $request->featured_img->move(public_path('asserts') , $image_name);

        $name = $request->site_logo->getClientOriginalName();
        $path = $request->site_logo->storeAs('/media_uploads', $name);

        $request->site_logo->move(public_path('media_uploads') , $name);

        $jsonString = "{\"favicon\" : \"$path\"}";
        // $jsonObject = json_decode($jsonString);

        $site_setting = Settings::findOrFail($id);
        $site_setting->site_name = $request->site_name;
        $site_setting->title = $request->title;
        $site_setting->header_scripts = $request->header_scripts;
        $site_setting->footer_scripts = $request->footer_scripts;
        $site_setting->nav_html = $request->nav_html;
        $site_setting->nav_css = $request->nav_css;
        $site_setting->nav_project_data = $jsonString;
        $site_setting->footer_html = $request->footer_html;
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

    //Site page functionality

    function SitePages(){
        $site_pages['site_pages'] = Pages::get();
        $site_pages['PageTitle'] = 'SitePages Dashboard';
        return view('admin.pages.sites.site_pages' , $site_pages);
    }
    function Create_Site_Pages(){
        // dd('site create page');
        $create_site_pages['PageTitle'] = 'SitePages Create Dashboard';
        return view('admin.pages.sites.create_site_pages' , $create_site_pages);
    }
    function SitePagesDetails($id){
        $page['pages'] = Pages::findOrFail($id);
        if($page){
            return view('front.index' , $page);
        } else {
            return abort(404);
        }
    }
    function Site_Pages_Saver(Request $request){
        // dd("error");die();
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
        // dd($request);

        $Pages = new Pages();
        $Pages->name = $request->name;
        $Pages->slug = $request->slug;
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
        $Pages['Pages'] = Pages::find($id);
        $Pages['PageTitle'] = 'Pages Update Dashboard';
        return view('admin.pages.sites.update_site_pages' , $Pages);
    }
    function Pages_Update_New(Request $request , $id){
        // dd("error");die();
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
        // dd($request);

        // $image_name = time().'.'.$request->featured_img->extension();
        // $request->featured_img->move(public_path('asserts') , $image_name);

        $Pages = Pages::findOrFail($id);
        $Pages->name = $request->name;
        $Pages->slug = $request->slug;
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
    public function PagesDelete($id)
    {
        $PagesDelete = Pages::findOrFail($id);
        $PagesDelete->delete();
        // session()->flash('error', 'No users present.');
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
        $Create_blogs['PageTitle'] = 'Blogs Create Dashboard';
        return view('admin.pages.blogs.create_blogs_pages' , $Create_blogs);
    }
    function Blogs_Saver(Request $request){
        // dd("error");die();
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        // dd($request);

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
        $blogs['blogs'] = Blogs::find($id);
        $blogs['PageTitle'] = 'Teams Dashboard';
        return view('admin.pages.blogs.update_blogs' , $blogs);
    }
    function Blogs_Update_New(Request $request , $id){
        // dd("error");die();
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        // dd($request);


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
    public function BlogDelete($id)
    {

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
        $Create_services['PageTitle'] = 'Services Create Dashboard';
        return view('admin.pages.services.create_services' , $Create_services);
    }
    function Services_Saver(Request $request){
        // dd("error");die();
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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
        // dd($request);


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
        $Services['Services'] = Services::find($id);
        $Services['PageTitle'] = 'Teams Dashboard';
        return view('admin.pages.services.update_services' , $Services);
    }
    function Services_Update_New(Request $request , $id){
        // dd("error");die();
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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
        // dd($request);


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
    public function Services_Delete($id)
    {

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
        $Create_teams['PageTitle'] = 'Teams Create Dashboard';
        return view('admin.pages.teams.create_teams' , $Create_teams);
    }
    function Teams_Saver(Request $request){
        // dd("error");die();
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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
        // dd($request);

        $Mediaextension = $request->featured_img->getClientOriginalExtension();
        $Mediafilename = $request->featured_img->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        // $image_name = time().'.'.$request->featured_img->extension();
        $request->featured_img->move(public_path('media_uploads') , $Mediafilename);

        $Teams = new Teams();
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
            return redirect(route('Create_Teams'))->with("error", "Registration failed");
        }
        return redirect(route('Teams'))->with("success", "Registered successfully");
    }
    function Teams_Update($id){
        $teams['teams'] = Teams::find($id);
        $teams['PageTitle'] = 'Teams Dashboard';
        return view('admin.pages.teams.update_team' , $teams);
    }
    function Teams_Update_New(Request $request , $id){
        // dd("error");die();
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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
        // dd($request);

        $Mediaextension = $request->featured_img->getClientOriginalExtension();
        $Mediafilename = $request->featured_img->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        // $image_name = time().'.'.$request->featured_img->extension();
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
    public function Teams_Delete($id)
    {
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
        // dd("error");die();
        $request->validate([
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        // dd($request);

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
    public function Media_Delete($id)
    {
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
