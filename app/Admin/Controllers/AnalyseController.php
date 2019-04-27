<?php

namespace App\Admin\Controllers;

use App\Fault;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AnalyseController extends Controller
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
            ->header('告警分析')
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
            ->header('Create')
            ->description('description')
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

        $grid->id('告警id');
        $grid->name('设备名称');
        $grid->analyse('分析原因');
        $grid->status('状态')->display(function ($status){
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

        $grid->disableCreateButton();
        $grid->disableActions();

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

        $show->id('Id');
        $show->name('Name');
        $show->range('Range');
        $show->analyse('Analyse');
        $show->status('Status');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

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

        $form->text('name', 'Name');
        $form->text('range', 'Range');
        $form->text('analyse', 'Analyse');
        $form->number('status', 'Status')->default(1);

        return $form;
    }
}
