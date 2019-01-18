<?php

namespace Modules\Advertisements\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterAdvertisementsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
//            $group->item(trans('advertisements::advertisements.title.advertisements'), function (Item $item) {
//                $item->icon('fa fa-life-ring');
//                $item->weight(10);
//                $item->authorize(
//                /* append */
//                );
//                $item->item(trans('advertisements::advertisements.title.advertisements'), function (Item $item) {
//                    $item->icon('fa fa-life-ring');
//                    $item->weight(0);
//                    $item->append('admin.advertisements.advertisement.create');
//                    $item->route('admin.advertisements.advertisement.index');
//                    $item->authorize(
//                        $this->auth->hasAccess('advertisements.advertisements.index')
//                    );
//                });
//            });
//        });

        return $menu;
    }
}
