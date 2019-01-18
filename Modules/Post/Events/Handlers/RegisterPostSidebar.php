<?php

namespace Modules\Post\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterPostSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
//        $menu->group(trans('core::sidebar.content'), function (Group $group) {
////            $group->item(trans('post::postcategories.post'), function (Item $item) {
////                $item->icon('fa fa-newspaper-o');
////                $item->weight(10);
////                $item->authorize(
////                     /* append */
////                );
////                $item->item(trans('post::postcategories.title.postcategories'), function (Item $item) {
////                    $item->icon('fa fa-id-card-o');
////                    $item->weight(0);
////                    $item->append('admin.post.postcategory.create');
////                    $item->route('admin.post.postcategory.index');
////                    $item->authorize(
////                        $this->auth->hasAccess('post.postcategories.index')
////                    );
////                });
////                $item->item(trans('post::managecategorys.title.managecategorys'), function (Item $item) {
////                    $item->icon('fa fa-newspaper-o');
////                    $item->weight(0);
////                    $item->append('admin.post.managecategorys.create');
////                    $item->route('admin.post.managecategorys.index');
////                    $item->authorize(
////                        $this->auth->hasAccess('post.managecategorys.index')
////                    );
////                });
////            });
//        });

        return $menu;
    }
}
