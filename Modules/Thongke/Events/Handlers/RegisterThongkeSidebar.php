<?php

namespace Modules\Thongke\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterThongkeSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('thongke::thongkes.title.thongkes'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('thongke::thongkedays.title.thongkedays'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.thongke.thongkeday.create');
                    $item->route('admin.thongke.thongkeday.index');
                    $item->authorize(
                        $this->auth->hasAccess('thongke.thongkedays.index')
                    );
                });
                $item->item(trans('thongke::thongketimes.title.thongketimes'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.thongke.thongketime.create');
                    $item->route('admin.thongke.thongketime.index');
                    $item->authorize(
                        $this->auth->hasAccess('thongke.thongketimes.index')
                    );
                });
                $item->item(trans('thongke::thongkehotels.title.thongkehotels'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.thongke.thongkehotel.create');
                    $item->route('admin.thongke.thongkehotel.index');
                    $item->authorize(
                        $this->auth->hasAccess('thongke.thongkehotels.index')
                    );
                });
                $item->item(trans('thongke::thongketourguides.title.thongketourguides'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.thongke.thongketourguide.create');
                    $item->route('admin.thongke.thongketourguide.index');
                    $item->authorize(
                        $this->auth->hasAccess('thongke.thongketourguides.index')
                    );
                });
// append




            });
        });

        return $menu;
    }
}
