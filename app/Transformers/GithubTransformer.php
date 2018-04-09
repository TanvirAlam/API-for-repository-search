<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class GithubTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($arr)
    {
        return [
            'Owner'    => $arr["Owner"],
            'Repository' => $arr["Repository"],
            'File' => $arr["File"]
        ];
    }
}
