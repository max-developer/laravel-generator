<?php echo '<?php'.PHP_EOL ?>

namespace <?php echo $this->SERVICE_CLASS_NAMESPACE ?>;

use <?php echo $this->MODEL_CLASS ?>;

class <?php echo $this->SERVICE_CLASS_NAME ?>
{
    /** @return <?php echo $this->MODEL_CLASS_NAME ?>[] */
    public function search(array $filter = [])
    {
        $query = <?php echo $this->MODEL_CLASS_NAME ?>::query();
        return $query->get();
    }

    public function create(array $data): <?php echo $this->MODEL_CLASS_NAME ?>
    {
        <?php echo $this->MODEL_CLASS_VARIABLE ?> = new <?php echo $this->MODEL_CLASS_NAME ?>($data);
        <?php echo $this->MODEL_CLASS_VARIABLE ?>->save();

        return <?php echo $this->MODEL_CLASS_VARIABLE ?>;
    }

    public function update(<?php echo $this->MODEL_CLASS_NAME ?> <?php echo $this->MODEL_CLASS_VARIABLE ?>, array $data): <?php echo $this->MODEL_CLASS_NAME ?>
    {
        <?php echo $this->MODEL_CLASS_VARIABLE ?>->fill($data);
        <?php echo $this->MODEL_CLASS_VARIABLE ?>->save();

        return <?php echo $this->MODEL_CLASS_VARIABLE ?>;
    }

    public function destroy(<?php echo $this->MODEL_CLASS_NAME ?> <?php echo $this->MODEL_CLASS_VARIABLE ?>): bool
    {
        return <?php echo $this->MODEL_CLASS_VARIABLE ?>->delete();
    }
}
