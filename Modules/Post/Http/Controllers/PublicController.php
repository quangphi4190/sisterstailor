<?php namespace Modules\Post\Http\Controllers;


use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Post\Entities\Managecategorys;
use Modules\Post\Entities\Postcategory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Input;
use Modules\Post\Repositories\ManagecategorysRepository;
use Modules\Category\Entities\Category;

class PublicController extends BasePublicController
{
    private $news;

    /**
     * @var FooterSliderRepository
     *
     * PublicController constructor.
     *
     * @param RoomRepository $managecategorysRepository
     */
    public function __construct(ManagecategorysRepository $news)
    {
        parent::__construct();
        $this->news = $news;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $countCart = 0;
        $news = Managecategorys::select('post__managecategorys.*', 'post__postcategories.name as categoryName', 'post__postcategories.slug as slugCategory')
            ->leftjoin('post__postcategories', 'post__postcategories.id', '=', 'post__managecategorys.category_id')
            ->paginate(10)->appends(Input::except('page'));;
        $category = Category::whereIn('id', [1, 2])->get();
        $othercategory = Category::whereNotIn('id', [1, 2])->where('parent_id', Null)->get();
        $danhmuctintucs = Postcategory::all();
        $nameMen = Category::where('parent_id', '1')->get();
        $nameWomen = Category::where('parent_id', '2')->get();

        return view('post::client.index', compact('news', 'category', 'countCart', 'danhmuctintucs', 'othercategory', 'nameMen', 'nameWomen'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category_detail($slug)
    {
        $countCart = 0;
        $getCategory = Postcategory::select('id', 'name')->where('slug', $slug)->first();
        $categorys = Managecategorys::select('post__managecategorys.*', 'post__postcategories.name as categoryName')
            ->leftjoin('post__postcategories', 'post__postcategories.id', '=', 'post__managecategorys.category_id')
            ->where('post__managecategorys.category_id', $getCategory->id)
            ->get();
        $nameMen = Category::where('parent_id', '1')->get();
        $nameWomen = Category::where('parent_id', '2')->get();
        $category = Category::whereIn('id', [1, 2])->get();
        $othercategory = Category::whereNotIn('id', [1, 2])->where('parent_id', Null)->get();
        $danhmuctintucs = Postcategory::all();
        return view('post::client.view_caterory', compact('categorys', 'category', 'countCart', 'danhmuctintucs', 'getCategory', 'othercategory', 'nameMen', 'nameWomen'));
    }

    public function slugCategory($slug)
    {
        $countCart = 0;
        $new_detail = Managecategorys::select('post__managecategorys.*', 'post__postcategories.id as IdCategory', 'post__postcategories.slug as SlugCategory', 'post__postcategories.name as categoryName')
            ->leftjoin('post__postcategories', 'post__postcategories.id', '=', 'post__managecategorys.category_id')
            ->where('post__managecategorys.slug', $slug)->first();
        $listCategorys = Postcategory::select('post__managecategorys.name', 'post__managecategorys.slug')
            ->leftjoin('post__managecategorys', 'post__managecategorys.category_id', '=', 'post__postcategories.id')
            ->where('post__postcategories.id', $new_detail->category_id)
            ->whereNotIn('post__managecategorys.id', [$new_detail->id])
            ->limit(5)->get();
        $category = Category::whereIn('id', [1, 2])->get();
        $nameMen = Category::where('parent_id', '1')->get();
        $nameWomen = Category::where('parent_id', '2')->get();
        $danhmuctintucs = Postcategory::all();
        $othercategory = Category::whereNotIn('id', [1, 2])->where('parent_id', Null)->get();
        return view('post::client.detail', compact('new_detail', 'category', 'countCart', 'danhmuctintucs', 'listCategorys', 'othercategory', 'nameMen', 'nameWomen'));
    }

    public function getSlug($slug)
    {
        if (!$slug) return '';
        $str = str_replace(" ", "-", $slug);
        $unicode = array(
            'a' => array('á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ặ', 'ằ', 'ẳ', 'ẵ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ'),
            'A' => array('Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ặ', 'Ằ', 'Ẳ', 'Ẵ', ' ', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ'),
            'd' => array('đ'),
            'D' => array('Đ'),
            'e' => array('é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ'),
            'E' => array('É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ'),
            'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị'),
            'I' => array('Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'),
            'o' => array('ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ'),
            'O' => array('Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ'),
            'u' => array('ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự'),
            'U' => array('Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự'),
            'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'),
            'Y' => array('Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
            '-' => array(' ', '&quot;', '.', '-–-')
        );
        foreach ($unicode as $nonUnicode => $uni) {
            foreach ($uni as $value)
                $str = @str_replace($value, $nonUnicode, $str);
            $str = preg_replace("/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/", "-", $str);
            $str = preg_replace("/-+-/", "-", $str);
            $str = preg_replace("/^\-+|\-+$/", "", $str);
        }
        return strtolower($str);
    }
}
