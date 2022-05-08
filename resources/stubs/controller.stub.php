<?php echo '<?php'.PHP_EOL ?>

namespace <?php echo $this->CONTROLLER_CLASS_NAMESPACE ?>;

use <?php echo $this->MODEL_CLASS ?>;
use <?php echo $this->SERVICE_CLASS ?>;
use Illuminate\Http\Request;

class <?php echo $this->CONTROLLER_CLASS_NAME ?> extends Controller
{
    public const ROUTE_INDEX = '<?php echo $this->MODEL_CLASS_FIELD_SNAKE ?>.index';

    private <?php echo $this->SERVICE_CLASS_NAME ?> $<?php echo $this->SERVICE_CLASS_FIELD ?>;

    public function __construct(<?php echo $this->SERVICE_CLASS_NAME ?> <?php echo $this->SERVICE_CLASS_VARIABLE ?>)
    {
        $this-><?php echo $this->SERVICE_CLASS_FIELD ?> = <?php echo $this->SERVICE_CLASS_VARIABLE ?>;
    }

    public function index()
    {
        <?php echo $this->MODEL_CLASS_VARIABLE_PLURAL ?> = $this-><?php echo $this->SERVICE_CLASS_FIELD ?>->search();
        return view('<?php echo $this->MODEL_CLASS_FIELD_SNAKE ?>.index', compact('<?php echo $this->MODEL_CLASS_FIELD_PLURAL ?>'));
    }

    public function create()
    {
        <?php echo $this->MODEL_CLASS_VARIABLE ?> = new <?php echo $this->MODEL_CLASS_NAME ?>();
        return view('<?php echo $this->MODEL_CLASS_FIELD_SNAKE ?>.create', compact('<?php echo $this->MODEL_CLASS_FIELD ?>'));
    }

    public function store(<?php echo $this->MODEL_CLASS_NAME ?>Request $request)
    {
        $data = $request->validated();
        $this-><?php echo $this->SERVICE_CLASS_FIELD ?>->create($data);

        return redirect()->route(self::ROUTE_INDEX)->with('success', '<?php echo $this->MODEL_CLASS_SINGULAR_UC ?> created');
    }

    public function show(<?php echo $this->MODEL_CLASS_NAME ?> <?php echo $this->MODEL_CLASS_VARIABLE ?>)
    {
        return view('<?php echo $this->MODEL_CLASS_FIELD_SNAKE ?>.show', compact('<?php echo $this->MODEL_CLASS_FIELD ?>'));
    }

    public function edit(<?php echo $this->MODEL_CLASS_NAME ?> <?php echo $this->MODEL_CLASS_VARIABLE ?>)
    {
        return view('<?php echo $this->MODEL_CLASS_FIELD_SNAKE ?>.edit', compact('<?php echo $this->MODEL_CLASS_FIELD ?>'));
    }

    public function update(<?php echo $this->MODEL_CLASS_NAME ?>Request $request, <?php echo $this->MODEL_CLASS_NAME ?> <?php echo $this->MODEL_CLASS_VARIABLE ?>)
    {
        $data = $request->validated();
        $this-><?php echo $this->SERVICE_CLASS_FIELD ?>->update(<?php echo $this->MODEL_CLASS_VARIABLE ?>, $data);

        return redirect()->route(self::ROUTE_INDEX)->with('success', '<?php echo $this->MODEL_CLASS_SINGULAR_UC ?> updated');
    }

    public function destroy(<?php echo $this->MODEL_CLASS_NAME ?> <?php echo $this->MODEL_CLASS_VARIABLE ?>)
    {
        $this-><?php echo $this->SERVICE_CLASS_FIELD ?>->destroy(<?php echo $this->MODEL_CLASS_VARIABLE ?>);
        return redirect()->route(self::ROUTE_INDEX)->with('success', '<?php echo $this->MODEL_CLASS_SINGULAR_UC ?> deleted');
    }
}
