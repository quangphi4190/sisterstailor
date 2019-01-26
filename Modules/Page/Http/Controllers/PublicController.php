<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Menu\Repositories\MenuItemRepository;
use Modules\Page\Entities\Page;
use Modules\Page\Repositories\PageRepository;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Entities\Category;
use Modules\Products\Repositories\ProductsRepository;
use Modules\Products\Entities\Products;
use Modules\Advertisements\Entities\Advertisement;
use Modules\Advertisements\Repositories\AdvertisementRepository;
use Modules\Banner\Repositories\BannerRepository;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class PublicController extends BasePublicController
{
    /**
     * @var PageRepository
     */
    private $page;
    /**
     * @var Application
     */
    private $app;

    private $disabledPage = false;

    public function __construct(PageRepository $page, Application $app)
    {
        parent::__construct();
        $this->page = $page;
        $this->app = $app;
    }

    /**
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function uri($slug)
    {
        $page = $this->findPageForSlug($slug);

        $this->throw404IfNotFound($page);

        $currentTranslatedPage = $page->getTranslation(locale());
        if ($slug !== $currentTranslatedPage->slug) {

            return redirect()->to($currentTranslatedPage->locale . '/' . $currentTranslatedPage->slug, 301);
        }

        $template = $this->getTemplateForPage($page);

        $alternate = $this->getAlternateMetaData($page);
        dd($alternate);

        return view($template, compact('page', 'alternate'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function homepage(ProductsRepository $productsrepoitory,AdvertisementRepository $advertisementRepository,BannerRepository $bannerRepository)
    {
        $page = $this->page->findHomepage();

        $this->throw404IfNotFound($page);

        $template = $this->getTemplateForPage($page);
        $category = Category::where('id','1')->orwhere('id','2')->get();
        $nameMen = Category::where('parent_id','1')->get();
        $nameWomen  =   Category::where('parent_id','2')->get();
        $alternate = $this->getAlternateMetaData($page);
        $categoryMen = Category::where('parent_id','1')->pluck('id');
        $categoryWomen = Category::where('parent_id','2')->pluck('id');
        $featured = Products::where('featured','1')->where('status','1')->orderBy('id','DESC')->take(12)->get();
        $othercategory = Category::whereNotIn('id',[1,2])->where('parent_id',Null)->get();
        $women   = Products::whereIn('category_id',$categoryWomen)->Orwhere('category_id','2')->orderBy('id','DESC')->take(4)->get();
        $men     = Products::whereIn('category_id',$categoryMen)->Orwhere('category_id','1')->orderBy('id','DESC')->take(4)->get();
        $adver = Advertisement::orderBy('id','DES')->get();
        // foreach ($adver as $key => $value){
        //     dd($key);
        // }
        
        $banner = $bannerRepository->all();
        // dd($banner);

        return view($template, compact('nameWomen','nameMen','othercategory','page', 'alternate','countCart','men','women','adver','banner','category','featured'));
    }

    /**
     * Find a page for the given slug.
     * The slug can be a 'composed' slug via the Menu
     * @param string $slug
     * @return Page
     */
    private function findPageForSlug($slug)
    {
        $menuItem = app(MenuItemRepository::class)->findByUriInLanguage($slug, locale());

        if ($menuItem) {
            return $this->page->find($menuItem->page_id);
        }

        return $this->page->findBySlug($slug);
    }

    /**
     * Return the template for the given page
     * or the default template if none found
     * @param $page
     * @return string
     */
    private function getTemplateForPage($page)
    {
        return (view()->exists($page->template)) ? $page->template : 'default';
    }

    /**
     * Throw a 404 error page if the given page is not found or draft
     * @param $page
     */
    private function throw404IfNotFound($page)
    {
        if (null === $page || $page->status === $this->disabledPage) {
            $this->app->abort('404');
        }
    }

    /**
     * Create a key=>value array for alternate links
     *
     * @param $page
     *
     * @return array
     */
    private function getAlternateMetaData($page)
    {
        $translations = $page->getTranslationsArray();

        $alternate = [];
        foreach ($translations as $locale => $data) {
            $alternate[$locale] = $data['slug'];
        }

        return $alternate;
    }
    public function category(){
        return view('Themes/Sisterstailor/views/category');
    }

    public function addCart(){
        die('sda');
    }
}
