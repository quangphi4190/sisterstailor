<?php

namespace Modules\Products\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterProductsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group('Website bán hàng', function (Group $group) {
            $group->item(trans('products::products.title.products'), function (Item $item) {
                $item->icon('fa fa-product-hunt');
                $item->weight(1);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('products::products.title.products'), function (Item $item) {
                    $item->icon('fa fa-product-hunt');
                    $item->weight(0);
                    $item->append('admin.products.products.create');
                    $item->route('admin.products.products.index');
                    $item->authorize(
                        $this->auth->hasAccess('products.products.index')
                    );
                });
                $item->item(trans('category::categories.title.categories'), function (Item $item) {
                    $item->icon('fa fa-delicious');
                    $item->weight(0);
                    $item->append('admin.category.category.create');
                    $item->route('admin.category.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('category.categories.index')
                    );
                });
            });
            $group->item(trans('post::postcategories.post'), function (Item $item) {
                $item->icon('fa fa-newspaper-o');
                $item->weight(10);
                $item->authorize(
                );
                $item->item(trans('post::postcategories.title.postcategories'), function (Item $item) {
                    $item->icon('fa fa-id-card-o');
                    $item->weight(0);
                    $item->append('admin.post.postcategory.create');
                    $item->route('admin.post.postcategory.index');
                    $item->authorize(
                        $this->auth->hasAccess('post.postcategories.index')
                    );
                });
                $item->item(trans('post::managecategorys.title.managecategorys'), function (Item $item) {
                    $item->icon('fa fa-newspaper-o');
                    $item->weight(0);
                    $item->append('admin.post.managecategorys.create');
                    $item->route('admin.post.managecategorys.index');
                    $item->authorize(
                        $this->auth->hasAccess('post.managecategorys.index')
                    );
                });
            });
            $group->item(trans('advertisements::advertisements.title.advertisements'), function (Item $item) {
                $item->icon('fa fa-life-ring');
                $item->weight(10);
                $item->authorize(
                );
                $item->item(trans('advertisements::advertisements.title.advertisements'), function (Item $item) {
                    $item->icon('fa fa-life-ring');
                    $item->weight(0);
                    $item->append('admin.advertisements.advertisement.create');
                    $item->route('admin.advertisements.advertisement.index');
                    $item->authorize(
                        $this->auth->hasAccess('advertisements.advertisements.index')
                    );
                });
            });
            $group->item(trans('banner::banners.title.banners'), function (Item $item) {
                $item->icon('fa fa-picture-o');
                $item->weight(10);
                $item->authorize(
                );
                $item->item(trans('banner::banners.title.banners'), function (Item $item) {
                    $item->icon('fa fa-picture-o');
                    $item->weight(0);
                    $item->append('admin.banner.banner.create');
                    $item->route('admin.banner.banner.index');
                    $item->authorize(
                        $this->auth->hasAccess('banner.banners.index')
                    );
                });
            });
            $group->item(trans('contact::contacts.title.contacts'), function (Item $item) {
                $item->icon('fa fa-compress');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('contact::contacts.title.contacts'), function (Item $item) {
                    $item->icon('fa fa-compress');
                    $item->weight(0);
                    $item->append('admin.contact.contact.create');
                    $item->route('admin.contact.contact.index');
                    $item->authorize(
                        $this->auth->hasAccess('contact.contacts.index')
                    );
                });
            });

        });

        return $menu;
    }
}
