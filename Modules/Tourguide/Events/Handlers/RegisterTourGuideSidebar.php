<?php

namespace Modules\Tourguide\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterTourGuideSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
        $menu->group('Quản lý bán hàng', function (Group $group) {
            $group->item(trans('tourguide::tourguides.title.tourguides'), function (Item $item) {
                $item->icon('fa fa-users');
                $item->weight(2);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('tourguide::tourguides.title.tourguidess'), function (Item $item) {
                    $item->icon('fa fa-users');
                    $item->weight(0);
                    $item->append('admin.tourguide.tourguide.create');
                    $item->route('admin.tourguide.tourguide.index');
                    $item->authorize(
                        $this->auth->hasAccess('tourguide.tourguides.index')
                    );
                });
            });
        });

        return $menu;
    }
}
