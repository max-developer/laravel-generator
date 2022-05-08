<?php echo '<?php'.PHP_EOL ?>

namespace <?php echo $this->CONTROLLER_CLASS_NAMESPACE ?>;

use <?php echo $this->MODEL_CLASS ?>;
use <?php echo $this->SERVICE_CLASS ?>;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class <?php echo $this->CONTROLLER_CLASS_NAME ?> extends Controller
{
    private <?php echo $this->SERVICE_CLASS_NAME ?> $<?php echo $this->SERVICE_CLASS_FIELD ?>;

    public function __construct(<?php echo $this->SERVICE_CLASS_NAME ?> <?php echo $this->SERVICE_CLASS_VARIABLE ?>)
    {
        $this-><?php echo $this->SERVICE_CLASS_FIELD ?> = <?php echo $this->SERVICE_CLASS_VARIABLE ?>;
    }

    public function index()
    {
        <?php echo $this->MODEL_CLASS_VARIABLE_PLURAL ?> = $this-><?php echo $this->SERVICE_CLASS_FIELD ?>->search();
        return <?php echo $this->MODEL_CLASS_NAME ?>Resource::collection(<?php echo $this->MODEL_CLASS_VARIABLE_PLURAL ?>);
    }

    public function store(<?php echo $this->MODEL_CLASS_NAME ?>Request $request)
    {
        $data = $request->validated();
        <?php echo $this->MODEL_CLASS_VARIABLE ?> = $this-><?php echo $this->SERVICE_CLASS_FIELD ?>->create($data);

        return <?php echo $this->MODEL_CLASS_NAME ?>Resource::make(<?php echo $this->MODEL_CLASS_VARIABLE ?>);
    }

    public function show(<?php echo $this->MODEL_CLASS_NAME ?> <?php echo $this->MODEL_CLASS_VARIABLE ?>)
    {
        return <?php echo $this->MODEL_CLASS_NAME ?>Resource::make(<?php echo $this->MODEL_CLASS_VARIABLE ?>);
    }

    public function update(<?php echo $this->MODEL_CLASS_NAME ?>Request $request, <?php echo $this->MODEL_CLASS_NAME ?> <?php echo $this->MODEL_CLASS_VARIABLE ?>)
    {
        $data = $request->validated();
        <?php echo $this->MODEL_CLASS_VARIABLE ?> = $this-><?php echo $this->SERVICE_CLASS_FIELD ?>->update(<?php echo $this->MODEL_CLASS_VARIABLE ?>, $data);

        return <?php echo $this->MODEL_CLASS_NAME ?>Resource::make(<?php echo $this->MODEL_CLASS_VARIABLE ?>);
    }

    public function destroy(<?php echo $this->MODEL_CLASS_NAME ?> <?php echo $this->MODEL_CLASS_VARIABLE ?>)
    {
        $this-><?php echo $this->SERVICE_CLASS_FIELD ?>->destroy(<?php echo $this->MODEL_CLASS_VARIABLE ?>);
        return response(Response::HTTP_NO_CONTENT);
    }
}
