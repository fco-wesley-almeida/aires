<?php

namespace App\Src\Business\Validations;


use App\Src\Business\Exceptions\ValidationErrorException;
use App\Src\Business\Utils\DefaultErrorMessages;
use DateTime;
use Exception;
use Illuminate\Database\QueryException;

/**
 * Class Validation
 * @package App\Src\Business\Validations
 */
abstract class Validation
{
    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * @return array:
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return bool :
     */
    public function hasError(): bool
    {
        return !!$this->errors;
    }

    /**
     * @param string $errorMessage
     * @return callable
     */
    protected function isInteger (string $errorMessage = DefaultErrorMessages::FIELD_MUST_BE_INTEGER): callable {
        return function ($value) use ($errorMessage): string  {
            if ($value === null) {
                return '';
            }
            $str = (string)$value;
            $testResult = preg_match('/^\d+$/', $str);
            return $testResult ? '' : $errorMessage;
        };
    }
    /**
     * @param string $errorMessage
     * @return callable
     */
    protected function isEmail (string $errorMessage = DefaultErrorMessages::INVALID_EMAIL): callable {
        return function ($value) use ($errorMessage): string  {
            if ($value === null) {
                return '';
            } else {
                $isValid = preg_match('/.*@.*\..*/', $value);
                return $isValid ? '' : $errorMessage;
            }
        };
    }
    /**
     * @param string $errorMessage
     * @return callable
     */
    protected function isRequired (string $errorMessage = DefaultErrorMessages::REQUIRED_FIELD): callable {
        return function ($value) use ($errorMessage): string  {
            return $value === null ? $errorMessage : '';
        };
    }

    /**
     * @param string $errorMessage
     * @return callable
     */
    protected function isNotEmpty (string $errorMessage = DefaultErrorMessages::NOT_EMPTY_FIELD): callable
    {
        return function ($value) use ($errorMessage): string  {
            if ($value === null) {
                return '';
            } else {
                return $value == '' ? $errorMessage : '';
            }
        };
    }

    /**
     * @param string $errorMessage
     * @return callable
     */
    protected function isValidDate (string $errorMessage = DefaultErrorMessages::INVALID_DATE): callable {
        return function ($value) use ($errorMessage): string  {
            if ($value === null) {
                return '';
            } else {
                try {
                    new DateTime($value);
                    return '';
                } catch (Exception $exception) {
                    return $errorMessage;
                }
            }
        };
    }

    /**
     * @param string $errorMessage
     * @return callable
     */
    protected function isHourMinuteSecond (string $errorMessage = DefaultErrorMessages::INVALID_DATETIME): callable {
        return function ($value) use ($errorMessage): string  {
            if ($value === null) {
                return '';
            } else {
                $isValid = preg_match('/\d{2}:\d{2}:\d{2}/', $value);
                return $isValid ? '' : $errorMessage;
            }
        };
    }

    /**
     * @param int $minNumChars
     * @param string $errorMessage
     * @return callable
     */
    protected function minLength (int $minNumChars, string $errorMessage = DefaultErrorMessages::MIN_CHARACTERS): callable {
        return function ($value) use ($errorMessage, $minNumChars): string  {
            if ($value === null) {
                return '';
            }
            $isValid = strlen($value) >= $minNumChars;
            return $isValid ? '' : $errorMessage;
        };
    }

    /**
     * @param int $maxNumChars
     * @param string $errorMessage
     * @return callable
     */
    protected function maxLength (int $maxNumChars, string $errorMessage = DefaultErrorMessages::MAX_CHARACTERS): callable {
        return function ($value) use ($errorMessage, $maxNumChars): string  {
            if ($value === null) {
                return '';
            }
            $isValid = strlen($value) <= $maxNumChars;
            return $isValid ? '' : $errorMessage;
        };
    }

    /**
     * @throws ValidationErrorException
     */
    final protected function validate (array $valuesArray, array $validations): void {
        $valuesArrayKeys = array_keys($valuesArray);
        foreach ($validations as $field => $fieldValidations):
            foreach ($fieldValidations as $fieldValidation):
                $valueToBeValidated = in_array($field, $valuesArrayKeys) ? $valuesArray[$field] : null;
                if (gettype($valueToBeValidated) === 'string'):
                    $valueToBeValidated = trim($valueToBeValidated);
                endif;
                $validationError = $fieldValidation($valueToBeValidated);
                if ($validationError):
                    $this->errors[$field] = $validationError;
                    break;
                endif;
            endforeach;
        endforeach;
        if ($this->hasError()) {
            throw new ValidationErrorException($this->errors);
        }
    }

    /**
     * @return array
     */
    protected abstract function getPersistenceRules(): array;

    /**
     * @param array $postData
     */
    protected abstract function validations(): array;

    /**
     * @throws ValidationErrorException
     */
    public function applyValidations (array $dataPost): void {
        $validations = $this->validations();
        $this->validate($dataPost, $validations);
    }
    /**
     * @throws ValidationErrorException
     */
    public function validatePersistenceErrors(QueryException $exception): void
    {
        $exceptionError = $exception->getPrevious()->getMessage();
        $rules = $this->getPersistenceRules();
        foreach ($rules as $key => $message)
        {
            if (str_contains($exceptionError, $key))
            {
                throw new ValidationErrorException($message);
            }
        }
    }
}
