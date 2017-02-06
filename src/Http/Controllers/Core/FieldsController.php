<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Illuminate\Http\Request;
use Hechoenlaravel\JarvisFoundation\Traits\EntityManager;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;
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
    use EntityManager;


    /**
     * @var FieldModel
     */
    protected $model;

    /**
     * @var
     */
    protected $fieldType;

    /**
     * FieldsController constructor.
     * @param FieldModel $model
     */
    public function __construct(FieldModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $model = $this->model->byEntity($id)->orderBy('order', 'ASC');
        return response()->json(fractal()->collection($model->get(), new FieldTransformer())->toArray());
    }

    /**
     * @param CreateFieldRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateFieldRequest $request, $id)
    {
        $data = $request->all();
        $data['entity_id'] = $id;
        $field = $this->generateField($data);
        $response = fractal()->item($field, new FieldTransformer())
            ->addMeta(['return_url' => $data['returnUrl']])
            ->toArray();
        return response()->json($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $response = fractal()->item($this->model->findOrFail($id), new FieldTransformer())->toArray();
        return response()->json($response);
    }


    /**
     * @param EditFieldRequest $request
     * @param $id
     * @param $fields
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditFieldRequest $request, $id, $fields)
    {
        $data = $request->all();
        $data['id'] = $fields;
        $field = $this->editField($data);
        $response = fractal()->item($field, new FieldTransformer())
            ->addMeta(['return_url' => $data['returnUrl']])
            ->toArray();
        return response()->json($response);
    }


    /**
     * @param $id
     * @param $fields
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, $fields)
    {
        $this->deleteField($fields);
        return response()->json(null, 204);
    }


    /**
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function fieldTypeForm($type)
    {
        $this->setFieldType($type);
        return response()->json(['form' => $this->fieldType->getOptionsForm()]);
    }


    /**
     * @param $type
     */
    private function setFieldType($type)
    {
        $fieldTypes = app('field.types');
        if (!isset($fieldTypes->types[$type])) {
            throw new NotAcceptableHttpException('El field type ' . $type . ' no esta registrado');
        }
        $this->fieldType = app($fieldTypes->types[$type]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function reOrderFieldId(Request $request, $id)
    {
        $this->reOrderField($request->get('items'));
        return response()->json(['ok' => true]);
    }
}
