<?php
class Validate
{
    private $errors = array();

    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                // We get the value from Get or Post.
                $value = $source[$item];
                // If there is no special 'name' field in the sent input, we cause an error with the input's own name.
                $inputName = (isset($rules['name'])) ? $rules['name'] : $item;

                // null value control
                if ($rule == 'required' && empty($value)) {
                    $this->addError("[{$inputName}] The field cannot be left blank.");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen(trim($value)) < $rule_value)
                                $this->addError("[{$inputName}] Minimum area {$rule_value} character must be.");
                            break;
                        case 'max':
                            if (strlen(trim($value)) > $rule_value)
                                $this->addError("[{$rule_value}] Maximum area {$rule_value} character must be.");
                            break;
                        case 'email';
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL))
                                $this->addError("[{$inputName}] A real e-mail address must be entered in the field!.");
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value])
                                $this->addError("[{$inputName}] with area [{$rule_value}] field does not match!.");
                        default:
                            break;
                    }
                }
            }
        }
    }

    // Add err function
    private function addError($message)
    {
        $this->errors[] = $message;
    }
    public function showError()
    {
        foreach ($this->errors as $error) {
            echo "<pre>";
            echo "{$error}";
            echo "</pre>";
        }
    }
    public function passed()
    {
        return (empty($this->errors)) ? true : false;
    }
}
