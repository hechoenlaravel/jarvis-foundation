<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Illuminate\Http\Request;
use Hechoenlaravel\JarvisFoundation\Http\Requests;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Hechoenlaravel\JarvisFoundation\Traits\EntityManager;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
use Hechoenlaravel\JarvisFoundation\Http\Requests\EditFieldRequest;
use Hechoenlaravel\JarvisFoundation\Http\Requests\CreateFieldRequest;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\Transformers\FieldTransformer;

/**
 * Class FieldsController
 * @package Hechoenlaravel\JarvisFoundation\Http\Controllers\Core
 */
class FieldsController extends Controller
{
    use ResponderTrait, EntityManager;

    /**
     * Field Model
     * @var FieldModel
     */
    protected $model;

    /**
     * Field Type
     * @var
     */
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
        $model = $this->model->byEntity($id)->orderBy('order', 'ASC');
        return $this->responseWithCollection($model, new FieldTransformer());
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
        return $this->responseWithItem($this->model->findOrFail($id), new FieldTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditFieldRequest $request, $id, $fields)
    {
        $data = $request->all();
        $data['id'] = $fields;
        $field = $this->editField($data);
        return $this->response->item($field, new FieldTransformer(), [], function ($resource, $fractal) use ($data) {
            $resource->setMetaValue('return_url', $data['returnUrl']);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $fields)
    {
        $this->deleteField($fields);
        return $this->responseNoContent();
    }

    /**
     * Get the Assignment Form
     * @param $type
     * @return mixed
     * @throws \NotAcceptableHttpException
     */
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

    /**
     * Re order the field
     * @param Request $request
     * @param $id
     * @param $field
     * @return mixed
     */
    public function reOrderFieldId(Request $request, $id)
    {
        $this->reOrderField($request->get('items'));
        return $this->simpleArray(['ok' => true]);
    }
}
