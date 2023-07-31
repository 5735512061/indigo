<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin;
use App\Model\ImageSlide;
use App\Model\ImageLogo;
use App\Model\ImageLink;
use App\Model\contact;
use App\Model\Promotion;
use App\Model\PromotionImageMulti;
use App\Model\Article;
use App\Model\ArticleImageMulti;
use App\Model\Review;
use App\Model\TourType;
use App\Model\Tour;
use App\Model\TourImageMulti;
use App\Model\TourPrice;
use App\Model\TourPricePromotion;

use Validator;
use DB;
use Auth;

class AdminsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function changeProfileIndex($id){
        $profile = Admin::findOrFail($id);
        return view('backend/admin/profile-change')->with('profile',$profile);
    }

    public function changeProfile(Request $request){
        $validator = Validator::make($request->all(), $this->rules_changeProfile(), $this->messages_changeProfile());
        if($validator->passes()) {
            $id = $request->get('id');
            
            $profile = Admin::findOrFail($id);
            $profile->update($request->all());

            Auth::guard('admin')->logout();
            $request->session()->flash('alert-success', 'เปลี่ยนข้อมูลส่วนตัวสำเร็จ เข้าสู่ระบบอีกครั้ง');
            return redirect('admin/login');
        } else {
            $request->session()->flash('alert-danger', 'เปลี่ยนข้อมูลส่วนตัวไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function imageSlide(Request $request) {
        $NUM_PAGE = 10;
        $image_slides = ImageSlide::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/page-website/slide')->with('NUM_PAGE',$NUM_PAGE)
                                                       ->with('page',$page)
                                                       ->with('image_slides',$image_slides);
    }

    public function createSlide(Request $request) {
        return view('backend/admin/page-website/create-slide');
    }

    public function createSlidePost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createSlidePost(), $this->messages_createSlidePost());
        if($validator->passes()) {
            $image_slide = $request->all();
            $image_slide = ImageSlide::create($image_slide);
            if($request->hasFile('image')){
                $slide = $request->file('image');
                $filename = md5(($slide->getClientOriginalName(). time()) . time()) . "_o." . $slide->getClientOriginalExtension();
                $slide->move('image_upload/image_slide/', $filename);
                $path = 'image_upload/image_slide/'.$filename;
                $image_slide->image = $filename;
                $image_slide->save();
            }
            $request->session()->flash('alert-success', 'เพิ่มรูปภาพสไลด์สำเร็จ');
            return redirect()->action('Backend\AdminsController@imageSlide');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มรูปภาพสไลด์ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function slideDelete($id) {
        ImageSlide::findOrFail($id)->delete();
        return back();
    }

    public function updateSlide(Request $request) {
        $id = $request->get('id');
        $image_slide = ImageSlide::findOrFail($id);
        $image_slide->update($request->all());
        if($request->hasFile('image')) {
            $slide = $request->file('image');
            $filename = md5(($slide->getClientOriginalName(). time()) . time()) . "_o." . $slide->getClientOriginalExtension();
            $slide->move('image_upload/image_slide/', $filename);
            $path = 'image_upload/image_slide/'.$filename;
            $image_slide = ImageSlide::findOrFail($id);
            $image_slide->image = $filename;
            $image_slide->save();
        }
        $request->session()->flash('alert-success', 'แก้ไขรูปภาพสไลด์สำเร็จ');
        return redirect()->action('Backend\AdminsController@imageSlide');
    }

    public function imageLogo(Request $request) {
        $NUM_PAGE = 10;
        $image_logos = ImageLogo::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/page-website/logo')->with('NUM_PAGE',$NUM_PAGE)
                                                      ->with('page',$page)
                                                      ->with('image_logos',$image_logos);
    }

    public function createLogo(Request $request) {
        return view('backend/admin/page-website/create-logo');
    }

    public function createLogoPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createLogoPost(), $this->messages_createLogoPost());
        if($validator->passes()) {
            $image_logo = $request->all();
            $image_logo = ImageLogo::create($image_logo);
            if($request->hasFile('image')){
                $logo = $request->file('image');
                $filename = md5(($logo->getClientOriginalName(). time()) . time()) . "_o." . $logo->getClientOriginalExtension();
                $logo->move('image_upload/image_logo/', $filename);
                $path = 'image_upload/image_logo/'.$filename;
                $image_logo->image = $filename;
                $image_logo->save();
            }
            $request->session()->flash('alert-success', 'เพิ่มรูปภาพโลโก้สำเร็จ');
            return redirect()->action('Backend\AdminsController@imageLogo');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มรูปภาพโลโก้ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function updateLogo(Request $request) {
        $id = $request->get('id');
        $image_logo = ImageLogo::findOrFail($id);
        $image_logo->update($request->all());
        if($request->hasFile('image')) {
            $slide = $request->file('image');
            $filename = md5(($slide->getClientOriginalName(). time()) . time()) . "_o." . $slide->getClientOriginalExtension();
            $slide->move('image_upload/image_logo/', $filename);
            $path = 'image_upload/image_logo/'.$filename;
            $image_logo = ImageLogo::findOrFail($id);
            $image_logo->image = $filename;
            $image_logo->save();
        }
        $request->session()->flash('alert-success', 'แก้ไขรูปภาพโลโก้สำเร็จ');
        return redirect()->action('Backend\AdminsController@imageLogo');
    }

    public function logoDelete($id) {
        ImageLogo::findOrFail($id)->delete();
        return back();
    }

    public function imageLink(Request $request) {
        $NUM_PAGE = 20;
        $images = ImageLink::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/image-link')->with('NUM_PAGE',$NUM_PAGE)
                                               ->with('page',$page)
                                               ->with('images',$images);
    }

    public function imageLinkPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_imageLinkPost(), $this->messages_imageLinkPost());
        if($validator->passes()) {
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_link/', $filename);
                $path = 'image_upload/image_link/'.$filename;
                $image_link = new ImageLink;
                $image_link->image = $filename;
                $image_link->admin_id = $request->get('admin_id');
                $image_link->save();
            }
            $request->session()->flash('alert-success', 'เพิ่มรูปภาพสำเร็จ');
            return redirect()->action('Backend\AdminsController@imageLink');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มรูปภาพไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function contact() {
        $id = Contact::value('id');
        $contact = Contact::findOrFail($id);
        return view('backend/admin/contact/index')->with('contact',$contact);
    }

    public function createContact(Request $request) {
        
        $validator = Validator::make($request->all(), $this->rules_createContact(), $this->messages_createContact());
        if($validator->passes()) {
            $id = $request->get('id');
            $contact = Contact::findOrFail($id);
            $contact->update($request->all());
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลติดต่อสำเร็จ');
            return redirect()->action('Backend\AdminsController@contact');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลติดต่อไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function promotion(Request $request) {
        $NUM_PAGE = 10;
        $promotions = Promotion::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/promotion/index')->with('NUM_PAGE',$NUM_PAGE)
                                                    ->with('page',$page)
                                                    ->with('promotions',$promotions);
    }

    public function createPromotion(Request $request) {
        return view('backend/admin/promotion/create-promotion');
    }

    public function createPromotionPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createPromotionPost(), $this->messages_createPromotionPost());
        if($validator->passes()) {
            if($request->hasFile('image_main')){
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_promotion_main/', $filename);
                $path = 'image_upload/image_promotion_main/'.$filename;

                DB::table('promotions')->insert([
                    'image_main' => $filename,
                    'admin_id' => $request->get('admin_id'),
                    'title' => $request->get('title'),
                    'title_eng' => $request->get('title_eng'),
                    'date' => $request->get('date'),
                    'expire' => $request->get('expire'),
                ]);

            }

            $promotion_id = Promotion::orderBy('id','desc')->value('id');
        

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_promotion_multi/'), $filename);

                        $promotion = new PromotionImageMulti;
                        $promotion->promotion_id = $promotion_id;
                        $promotion->image_multi = $filename;
                        $promotion->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'เพิ่มข้อมูลโปรโมชั่นสำเร็จ');
            return redirect()->action('Backend\AdminsController@promotion');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มข้อมูลโปรโมชั่นไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function promotionImageMultiInfor($id) {
        $image_multis = PromotionImageMulti::where('promotion_id',$id)->get();
        $promotion_id = $id;
        return view('backend/admin/promotion/image-multi-information')->with('image_multis',$image_multis)
                                                                      ->with('promotion_id',$promotion_id);
    }

    public function promotionDelete($id) {
        $image_multi = PromotionImageMulti::where('promotion_id',$id)->delete();
        Promotion::findOrFail($id)->delete();
        return back();
    }

    public function updatePromotion(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updatePromotion(), $this->messages_updatePromotion());
        if($validator->passes()) {
            $id = $request->get('id');
            $promotion = Promotion::findOrFail($id);
            $promotion->update($request->all());

            if($request->hasFile('image_main')) {
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_promotion_main/', $filename);
                $path = 'image_upload/image_promotion_main/'.$filename;
                $promotion = Promotion::findOrFail($id);
                $promotion->image_main = $filename;
                $promotion->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลโปรโมชั่นสำเร็จ');
            return redirect()->action('Backend\AdminsController@promotion');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลโปรโมชั่นไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function updatePromotionImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updatePromotionImageMulti(), $this->messages_updatePromotionImageMulti());
        if($validator->passes()) {
            $id = $request->get('id');
            $promotion = PromotionImageMulti::findOrFail($id);
            $promotion->update($request->all());

            if($request->hasFile('image_multi')) {
                $image = $request->file('image_multi');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_promotion_multi/', $filename);
                $path = 'image_upload/image_promotion_multi/'.$filename;
                $promotion = PromotionImageMulti::findOrFail($id);
                $promotion->image_multi = $filename;
                $promotion->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลโปรโมชั่นสำเร็จ');
            return redirect()->action('Backend\AdminsController@promotion');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลโปรโมชั่นไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function uploadPromotionImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updatePromotionImageMulti(), $this->messages_updatePromotionImageMulti());
        if($validator->passes()) {
            $promotion_id = $request->get('promotion_id');
        

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_promotion_multi/'), $filename);

                        $promotion = new PromotionImageMulti;
                        $promotion->promotion_id = $promotion_id;
                        $promotion->image_multi = $filename;
                        $promotion->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'อัพโหลดรูปภาพสำเร็จ');
            return redirect()->action('Backend\AdminsController@promotion');
        } else {
            $request->session()->flash('alert-danger', 'อัพโหลดรูปภาพไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function promotionImageMultiDelete($id) {
        $image_multi = PromotionImageMulti::where('id',$id)->delete();
        return back();
    }

    public function article(Request $request) {
        $NUM_PAGE = 10;
        $articles = Article::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/article/index')->with('NUM_PAGE',$NUM_PAGE)
                                                  ->with('page',$page)
                                                  ->with('articles',$articles);
    }

    public function createArticle(Request $request) {
        return view('backend/admin/article/create-article');
    }

    public function createArticlePost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createArticlePost(), $this->messages_createArticlePost());
        if($validator->passes()) {
            if($request->hasFile('image_main')){
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_article_main/', $filename);
                $path = 'image_upload/image_article_main/'.$filename;

                DB::table('articles')->insert([
                    'image_main' => $filename,
                    'admin_id' => $request->get('admin_id'),
                    'title' => $request->get('title'),
                    'title_eng' => $request->get('title_eng'),
                    'date' => $request->get('date'),
                    'article' => $request->get('article'),
                    'article_eng' => $request->get('article_eng'),
                ]);

            }

            $article_id = Article::orderBy('id','desc')->value('id');

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_article_multi/'), $filename);

                        $gallery = new ArticleImageMulti;
                        $gallery->article_id = $article_id;
                        $gallery->image_multi = $filename;
                        $gallery->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'เพิ่มข้อมูลบทความสำเร็จ');
            return redirect()->action('Backend\AdminsController@article');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มข้อมูลบทความไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function articleImageMultiInfor($id) {
        $image_multis = ArticleImageMulti::where('article_id',$id)->get();
        return view('backend/admin/article/image-multi-information')->with('image_multis',$image_multis)
                                                                    ->with('id',$id);
    }

    public function articleDelete($id) {
        $image_multi = ArticleImageMulti::where('article_id',$id)->delete();
        Article::findOrFail($id)->delete();
        return back();
    }

    public function updateArticle(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateArticle(), $this->messages_updateArticle());
        if($validator->passes()) {
            $id = $request->get('id');
            $article = Article::findOrFail($id);
            $article->update($request->all());

            if($request->hasFile('image_main')) {
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_article_main/', $filename);
                $path = 'image_upload/image_article_main/'.$filename;
                $article = Article::findOrFail($id);
                $article->image_main = $filename;
                $article->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลบทความสำเร็จ');
            return redirect()->action('Backend\AdminsController@article');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลบทความไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
        
    }

    public function editArticle($id) {
        $article = Article::findOrFail($id);
        return view('backend/admin/article/edit-article')->with('article',$article);
    }

    public function updateArticlePost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateArticlePost(), $this->messages_updateArticlePost());
        if($validator->passes()) {
            $id = $request->get('id');
            $article = Article::findOrFail($id);
            $article->update($request->all());
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลบทความสำเร็จ');
            return redirect()->action('Backend\AdminsController@article');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลบทความไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function updateArticleImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateArticleImageMulti(), $this->messages_updateArticleImageMulti());
        if($validator->passes()) {
            $id = $request->get('id');
            $article = ArticleImageMulti::findOrFail($id);
            $article->update($request->all());

            if($request->hasFile('image_multi')) {
                $image = $request->file('image_multi');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_article_multi/', $filename);
                $path = 'image_upload/image_article_multi/'.$filename;
                $article = ArticleImageMulti::findOrFail($id);
                $article->image_multi = $filename;
                $article->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลบทความสำเร็จ');
            return redirect()->action('Backend\AdminsController@article');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลบทความไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function uploadArticleImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_uploadArticleImageMulti(), $this->messages_uploadArticleImageMulti());
        if($validator->passes()) {
            $article_id = $request->get('id');

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_article_multi/'), $filename);

                        $gallery = new ArticleImageMulti;
                        $gallery->article_id = $article_id;
                        $gallery->image_multi = $filename;
                        $gallery->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'อัพโหลดรูปภาพสำเร็จ');
            return redirect()->action('Backend\AdminsController@article');
        } else {
            $request->session()->flash('alert-danger', 'อัพโหลดรูปภาพไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function articleImageMultiDelete($id) {
        $image_multi = ArticleImageMulti::where('id',$id)->delete();
        return back();
    }

    public function review(Request $request) {
        $NUM_PAGE = 10;
        $reviews = Review::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/review/index')->with('NUM_PAGE',$NUM_PAGE)
                                                 ->with('page',$page)
                                                 ->with('reviews',$reviews);
    }

    public function createReview(Request $request) {
        return view('backend/admin/review/create-review');
    }

    public function createReviewPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createReviewPost(), $this->messages_createReviewPost());
        if($validator->passes()) {
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_review/', $filename);
                $path = 'image_upload/image_review/'.$filename;

                DB::table('reviews')->insert([
                    'image' => $filename,
                    'admin_id' => $request->get('admin_id'),
                ]);

            }
            $request->session()->flash('alert-success', 'เพิ่มรูปภาพรีวิวสำเร็จ');
            return redirect()->action('Backend\AdminsController@review');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มรูปภาพรีวิวไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function reviewDelete($id) {
        Review::findOrFail($id)->delete();
        return back();
    }

    public function updateReview(Request $request) {
            $id = $request->get('id');
            $review = Review::findOrFail($id);
            $review->update($request->all());

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_review/', $filename);
                $path = 'image_upload/image_review/'.$filename;
                $review = Review::findOrFail($id);
                $review->image = $filename;
                $review->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขรูปภาพรีวิวสำเร็จ');
            return redirect()->action('Backend\AdminsController@review');
    }

    public function manageTourType(Request $request) {
        $NUM_PAGE = 10;
        $tour_types = TourType::where('status','เปิด')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/tour/manage-tour-type')->with('NUM_PAGE',$NUM_PAGE)
                                                          ->with('page',$page)
                                                          ->with('tour_types',$tour_types);
    }

    public function createTourType(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createTourType(), $this->messages_createTourType());
        if($validator->passes()) {
            $type = $request->all();
            $type = TourType::create($type);
            $request->session()->flash('alert-success', 'เพิ่มข้อมูลสำเร็จ');
            return redirect()->action('Backend\AdminsController@manageTourType');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มข้อมูลไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function tourTypeDelete($id) {
        TourType::findOrFail($id)->delete();
        return back();
    }

    public function updateTourType(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createTourType(), $this->messages_createTourType());
        if($validator->passes()) {
            $id = $request->get('id');
            $review = TourType::findOrFail($id);
            $review->update($request->all());
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลสำเร็จ');
            return redirect()->action('Backend\AdminsController@manageTourType');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function tour(Request $request) {
        $NUM_PAGE = 10;
        $tours = Tour::where('status','เปิด')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/tour/index')->with('NUM_PAGE',$NUM_PAGE)
                                               ->with('page',$page)
                                               ->with('tours',$tours);
    }

    public function createTour(Request $request) {
        return view('backend/admin/tour/create-tour');
    }

    public function createTourPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createTourPost(), $this->messages_createTourPost());
        if($validator->passes()) {
            if($request->hasFile('image_main')){
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_tour_main/', $filename);
                $path = 'image_upload/image_tour_main/'.$filename;

                DB::table('tours')->insert([
                    'image_main' => $filename,
                    'admin_id' => $request->get('admin_id'),
                    'type_id' => $request->get('type_id'),
                    'title' => $request->get('title'),
                    'title_eng' => $request->get('title_eng'),
                    'date' => $request->get('date'),
                    'expire' => $request->get('expire'),
                ]);

            }

            $tour_id = Tour::orderBy('id','desc')->value('id');
        

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_tour_multi/'), $filename);

                        $promotion = new TourImageMulti;
                        $promotion->tour_id = $tour_id;
                        $promotion->image_multi = $filename;
                        $promotion->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'เพิ่มข้อมูลแพ็กเกจทัวร์สำเร็จ');
            return redirect()->action('Backend\AdminsController@tour');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มข้อมูลแพ็กเกจทัวร์ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function tourDelete($id) {
        $image_multi = TourImageMulti::where('tour_id',$id)->delete();
        Tour::findOrFail($id)->delete();    
        return back();
    }

    public function tourImageMultiInfor($id) {
        $image_multis = TourImageMulti::where('tour_id',$id)->get();
        return view('backend/admin/tour/image-multi-information')->with('image_multis',$image_multis)
                                                                 ->with('id',$id);
    }

    public function updateTour(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateTour(), $this->messages_updateTour());
        if($validator->passes()) {
            $id = $request->get('id');
            $tour = Tour::findOrFail($id);
            $tour->update($request->all());

            if($request->hasFile('image_main')) {
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_tour_main/', $filename);
                $path = 'image_upload/image_tour_main/'.$filename;
                $tour = Tour::findOrFail($id);
                $tour->image_main = $filename;
                $tour->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลแพ็กเกจทัวร์สำเร็จ');
            return redirect()->action('Backend\AdminsController@tour');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้ข้อมูลแพ็กเกจทัวร์ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
        
    }

    public function updateTourImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_uploadTourImageMulti(), $this->messages_uploadTourImageMulti());
        if($validator->passes()) {
            $id = $request->get('id');
            $tour = TourImageMulti::findOrFail($id);
            $tour->update($request->all());

            if($request->hasFile('image_multi')) {
                $image = $request->file('image_multi');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_tour_multi/', $filename);
                $path = 'image_upload/image_tour_multi/'.$filename;
                $tour = TourImageMulti::findOrFail($id);
                $tour->image_multi = $filename;
                $tour->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลแพ็กเกจทัวร์สำเร็จ');
            return redirect()->action('Backend\AdminsController@tour');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้ข้อมูลแพ็กเกจทัวร์ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function uploadTourImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_uploadTourImageMulti(), $this->messages_uploadTourImageMulti());
        if($validator->passes()) {
            $tour_id = $request->get('id');

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_tour_multi/'), $filename);

                        $gallery = new TourImageMulti;
                        $gallery->tour_id = $tour_id;
                        $gallery->image_multi = $filename;
                        $gallery->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'อัพโหลดรูปภาพสำเร็จ');
            return redirect()->action('Backend\AdminsController@tour');
        } else {
            $request->session()->flash('alert-danger', 'อัพโหลดรูปภาพไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function tourImageMultiDelete($id) {
        $image_multi = TourImageMulti::where('id',$id)->delete();
        return back();
    }

    public function tourPrice(Request $request) {
        $NUM_PAGE = 10;
        $tours = Tour::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/tour/tour-price')->with('NUM_PAGE',$NUM_PAGE)
                                                    ->with('page',$page)
                                                    ->with('tours',$tours);
    }

    public function updateTourPrice(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateTourPrice(), $this->messages_updateTourPrice());
        if($validator->passes()) {
            $price = $request->all();
            $price = TourPrice::create($price);
            $request->session()->flash('alert-success', 'อัพโหลดราคาสำเร็จ');
            return redirect()->action('Backend\AdminsController@tourPrice');
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดราคาไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function updateTourPricePromotion(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateTourPrice(), $this->messages_updateTourPrice());
        if($validator->passes()) {
            $price = $request->all();
            $price = TourPricePromotion::create($price);
            $request->session()->flash('alert-success', 'อัพโหลดราคาโปรโมชั่นสำเร็จ');
            return redirect()->action('Backend\AdminsController@tourPrice');
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดราคาโปรโมชั่นไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function tourPriceInformation(Request $request,$id) {
        $NUM_PAGE = 20;
        $tour_prices = TourPrice::where('tour_id',$id)->orderBy('id','desc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/tour/tour-price-information')->with('NUM_PAGE',$NUM_PAGE)
                                                                ->with('page',$page)
                                                                ->with('tour_prices',$tour_prices);
    }

    public function tourPricePromotionInformation(Request $request, $id) {
        $NUM_PAGE = 20;
        $tour_prices = TourPricePromotion::where('tour_id',$id)->orderBy('id','desc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/tour/tour-price-promotion-information')->with('NUM_PAGE',$NUM_PAGE)
                                                                          ->with('page',$page)
                                                                          ->with('tour_prices',$tour_prices);
    }

    public function rules_createContact() {
        return [
            'phone' => 'required',
            'facebook' => 'required',
            'line' => 'required',
        ];
    }

    public function messages_createContact() {
        return [
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'facebook.required' => 'กรุณากรอกชื่อ FACEBOOK',
            'line.required' => 'กรุณากรอกชื่อ LINE',
        ];
    }

    public function rules_createSlidePost() {
        return [
            'image' => 'required',
        ];
    }

    public function messages_createSlidePost() {
        return [
            'image.required' => 'กรุณาแนบไฟล์รูปภาพสไลด์',
        ];
    }

    public function rules_createLogoPost() {
        return [
            'image' => 'required',
        ];
    }

    public function messages_createLogoPost() {
        return [
            'image.required' => 'กรุณาแนบไฟล์รูปภาพโลโก้',
        ];
    }

    public function rules_changeProfile() {
        return [
            'name' => 'required',
            'username' => 'required',
        ];
    }

    public function messages_changeProfile() {
        return [
            'name.required' => 'กรุณากรอกชื่อ',
            'username.required' => 'กรุณากรอกชื่อเข้าใช้งาน',
        ];
    }

    public function rules_imageLinkPost() {
        return [
            'image' => 'required',
        ];
    }

    public function messages_imageLinkPost() {
        return [
            'image.required' => 'กรุณาแนบไฟล์รูปภาพ',
        ];
    }

    public function rules_createPromotionPost() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'date' => 'required',
            'expire' => 'required',
            'image_main' => 'required',
            'image_multi' => 'required',
        ];
    }

    public function messages_createPromotionPost() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อกิจกรรม',
            'title_eng.required' => 'กรุณากรอกหัวข้อกิจกรรม (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี เริ่มโปรโมชั่น',
            'expire.required' => 'กรุณากรอก วัน/เดือน/ปี สิ้นสุดโปรโมชั่น',
            'image_main.required' => 'กรุณาแนบไฟล์รูปภาพหลัก ขนาด 378*300 pixel',
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_updatePromotion() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'date' => 'required',
        ];
    }

    public function messages_updatePromotion() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อกิจกรรม',
            'title_eng.required' => 'กรุณากรอกหัวข้อกิจกรรม (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี',
        ];
    }

    public function rules_updatePromotionImageMulti() {
        return [
            'image_multi' => 'required',
        ];
    }

    public function messages_updatePromotionImageMulti() {
        return [
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_createArticlePost() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'article' => 'required',
            'article_eng' => 'required',
            'date' => 'required',
            'image_main' => 'required',
            'image_multi' => 'required',
        ];
    }

    public function messages_createArticlePost() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อเรื่อง',
            'title_eng.required' => 'กรุณากรอกหัวข้อเรื่อง (ภาษาอังกฤษ)',
            'article.required' => 'กรุณากรอกเนื้อหาข่าวสาร',
            'article_eng.required' => 'กรุณากรอกเนื้อหาข่าวสาร (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี',
            'image_main.required' => 'กรุณาแนบไฟล์รูปภาพหลัก ขนาด 378*300 pixel',
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_updateArticle() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'date' => 'required',
        ];
    }

    public function messages_updateArticle() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อเรื่อง',
            'title_eng.required' => 'กรุณากรอกหัวข้อเรื่อง (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี',
        ];
    }

    public function rules_updateArticlePost() {
        return [
            'article' => 'required',
            'article_eng' => 'required',
        ];
    }

    public function messages_updateArticlePost() {
        return [
            'article.required' => 'กรุณากรอกเนื้อหาข่าวสาร',
            'article_eng.required' => 'กรุณากรอกเนื้อหาข่าวสาร (ภาษาอังกฤษ)',
        ];
    }

    public function rules_updateArticleImageMulti() {
        return [
            'image_multi' => 'required',
        ];
    }

    public function messages_updateArticleImageMulti() {
        return [
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_uploadArticleImageMulti() {
        return [
            'image_multi' => 'required',
        ];
    }

    public function messages_uploadArticleImageMulti() {
        return [
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_createReviewPost() {
        return [
            'image' => 'required',
        ];
    }

    public function messages_createReviewPost() {
        return [
            'image.required' => 'กรุณาแนบไฟล์รูปภาพหลัก ขนาด 378*300 pixel',
        ];
    }

    public function rules_createTourType() {
        return [
            'type' => 'required',
            'type_eng' => 'required',
        ];
    }

    public function messages_createTourType() {
        return [
            'type.required' => 'กรุณากรอกประเภททัวร์',
            'type_eng.required' => 'กรุณากรอกประเภททัวร์ (ภาษาอังกฤษ)',
        ];
    }

    public function rules_createTourPost() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'date' => 'required',
            'expire' => 'required',
            'image_main' => 'required',
            'image_multi' => 'required',
        ];
    }

    public function messages_createTourPost() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อแพ็กเกจทัวร์',
            'title_eng.required' => 'กรุณากรอกหัวข้อแพ็กเกจทัวร์ (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี เริ่มต้น',
            'expire.required' => 'กรุณากรอก วัน/เดือน/ปี สิ้นสุด',
            'image_main.required' => 'กรุณาแนบไฟล์รูปภาพหลัก ขนาด 378*300 pixel',
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_updateTour() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'date' => 'required',
            'expire' => 'required',
        ];
    }

    public function messages_updateTour() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อแพ็กเกจทัวร์',
            'title_eng.required' => 'กรุณากรอกหัวข้อแพ็กเกจทัวร์ (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี เริ่มต้น',
            'expire.required' => 'กรุณากรอก วัน/เดือน/ปี สิ้นสุด',
        ];
    }

    public function rules_uploadTourImageMulti() {
        return [
            'image_multi' => 'required',
        ];
    }

    public function messages_uploadTourImageMulti() {
        return [
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_updateTourPrice() {
        return [
            'price' => 'required',
        ];
    }

    public function messages_updateTourPrice() {
        return [
            'price.required' => 'กรุณากรอกราคาแพ็กเกจทัวร์',
        ];
    }
}
