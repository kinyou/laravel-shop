<?php

namespace App\Admin\Controllers;

use App\Equipment;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class EquipmentController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('设备列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('设备详情')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('增加设备')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Equipment);

        $grid->id('设备编号');
        $grid->name('设备名称');
        $grid->oem('生成厂家');
        $grid->status('状态')->display(function($status){
            return $status == 1 ? 
            "<button type='button' class='btn btn-xs btn-success'>投入</button>" 
            : "<button type='button' class='btn btn-xs btn-warning'>备用</button>";
        });
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Equipment::findOrFail($id));

        $show->id('设备编号');
        $show->name('设备名称');
        $show->oem('生成厂家');
        $show->status('状态');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Equipment);

        $form->text('name', '设备名称');
        $form->text('oem', '生成厂家');
        $form->radio('status', '状态')->options(['1' => '是', '0'=> '否'])->default(1);

        return $form;
    }
}
