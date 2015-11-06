<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\UI;

use JavaScript;
use Hechoenlaravel\JarvisFoundation\Flows\Flow;

class FlowForm {

    public $flow = null;

    public $module;

    public $returnBaseUrl;

    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }

    public function setReturnBaseUrl($url)
    {
        $this->returnBaseUrl = $url;
        return $this;
    }

    public function setFlow($id)
    {
        $this->flow = Flow::findOrFail($id);
        return $this;
    }

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