<?php

namespace App\Admin\Controllers;

use App\Fault;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FaultController extends Controller
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
            ->header('告警状态列表')
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
            ->header('Detail')
            ->description('description')
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
            ->header('增加故障状态')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fault);

        $grid->id('告警编号');
        $grid->name('设备名称');
        $grid->range('故障范围');
        $grid->status('状态')->display(function($status){
            $tpl = "<button type='button' class='btn btn-xs btn-success'>正常</button>";

            if ($status == 2) {
                $tpl = "<button type='button' class='btn btn-xs btn-warning'>告警</button>";
            } elseif ($status == 3) {
                $tpl = "<button type='button' class='btn btn-xs btn-danger'>异常</button>";

            }

            return $tpl;
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
        $show = new Show(Fault::findOrFail($id));

        $show->id('告警编号');
        $show->name('设备名称');
        $show->range('故障范围');
        $show->status('状态')->display(function($status){
            $tpl = "<button type='button' class='btn btn-xs btn-success'>正常</button>";

            if ($status == 2) {
                $tpl = "<button type='button' class='btn btn-xs btn-warnging'>告警</button>";
            } elseif ($status == 3) {
                $tpl = "<button type='button' class='btn btn-xs btn-danger'>异常</button>";

            }

            return $tpl;
        });
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
        $form = new Form(new Fault);

        $form->text('name', '设备名称');
        $form->text('range', '故障范围');
        $form->text('analyse', '分析结论');
        $form->select('status', '状态')->options(['1' => '正常', '2'=> '告警','3'=>'异常'])->default(1);

        return $form;
    }
}
