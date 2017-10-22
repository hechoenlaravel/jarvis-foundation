<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\UI;

use JavaScript;
use Hechoenlaravel\JarvisFoundation\Flows\Flow;

/**
 * Class FlowForm
 *
 * @package Hechoenlaravel\JarvisFoundation\Flows\UI
 */
class FlowForm
{
    /**
     * @var null
     */
    public $flow = null;

    /**
     * @var
     */
    public $module;

    /**
     * @var
     */
    public $returnBaseUrl;

    /**
     * @param $module
     * @return $this
     */
    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setReturnBaseUrl($url)
    {
        $this->returnBaseUrl = $url;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setFlow($id)
    {
        $this->flow = Flow::findOrFail($id);
        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        JavaScript::put([
            'module' => $this->module,
            'flow' => $this->flow,
            'redirectBaseUrl' => $this->returnBaseUrl
        ]);
        return view('jarvisPlatform::flows.form')->with('flow', $this->flow)->render();
    }
}
