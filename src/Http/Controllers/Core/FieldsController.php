<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Illuminate\Http\Request;
use JarvisPlatform\Http\Requests;
use JarvisPlatform\Http\Controllers\Controller;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Hechoenlaravel\JarvisFoundation\Traits\EntityManager;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
use Hechoenlaravel\JarvisFoundation\Http\Requests\CreateFieldRequest;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\Transformers\FieldTransformer;

class FieldsController extends Controller
{

    use ResponderTrait, EntityManager;

    protected $model;

    protected $fieldType;

    public function __construct(FieldModel $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     * @param integer $id entity id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $model = $this->model->byEntity($id)->orderBy('order', 'DESC');
        return $this->responseWithCollection($model, new FieldTransformer());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a field for the entity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param String $id Entity Id
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFieldRequest $request, $id)
    {
        $data = $request->all();
        $data['entity_id'] = $id;
        $field = $this->generateField($data);
        return $this->response->item($field, new FieldTransformer(), [], function ($resource, $fractal) use ($data) {
            $resource->setMetaValue('return_url', $data['returnUrl']);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fieldTypeForm($type)
    {
        $this->setFieldType($type);
        return $this->simpleArray(['form' => $this->fieldType->getOptionsForm()]);
    }

    /**
     * @param $type
     * @return \Illuminate\Foundation\Application|mixed
     * @throws \NotAcceptableHttpException
     */
    private function setFieldType($type)
    {
        $fieldTypes = app('field.types');
        if (!isset($fieldTypes->types[$type])) {
            throw new \NotAcceptableHttpException('El field type ' . $type . ' no esta registrado');
        }
        $this->fieldType = app($fieldTypes->types[$type]);
    }
}
