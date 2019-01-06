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
        $menu->group('Quản lý bán hàng', function (Group $group) {
            $group->item('Thống kê', function (Item $item) {
                $item->icon('fa fa-bar-chart');
                $item->weight(4);
                $item->authorize(
                     /* append */
                );
                $item->item('Thống kê theo đoàn', function (Item $item) {
                    $item->icon('fa fa-bar-chart');
                    $item->weight(0);
                    $item->route('admin.thongke.khach_doan');

                });
                $item->item('Thống kê bán hàng', function (Item $item) {
                    $item->icon('fa fa-bar-chart');
                    $item->weight(1);
                    $item->route('admin.thongke.thongketime.index');
                    $item->authorize(
                        $this->auth->hasAccess('thongke.thongketimes.index')
                    );
                });
                $item->item('Thống kê doanh thu', function (Item $item) {
                    $item->icon('fa fa-line-chart');
                    $item->weight(2);

                    $item->route('admin.thongke.thong_ke_doanh_thu');

                });
                // $item->item(trans('thongke::thongkehotels.title.thongkehotels'), function (Item $item) {
                //     $item->icon('fa fa-copy');
                //     $item->weight(0);
                //     $item->append('admin.thongke.thongkehotel.create');
                //     $item->route('admin.thongke.thongkehotel.index');
                //     $item->authorize(
                //         $this->auth->hasAccess('thongke.thongkehotels.index')
                //     );
                // });
                // $item->item(trans('thongke::thongketourguides.title.thongketourguides'), function (Item $item) {
                //     $item->icon('fa fa-copy');
                //     $item->weight(0);
                //     $item->append('admin.thongke.thongketourguide.create');
                //     $item->route('admin.thongke.thongketourguide.index');
                //     $item->authorize(
                //         $this->auth->hasAccess('thongke.thongketourguides.index')
                //     );
                // });
// append




            });
        });

        return $menu;
    }
}
