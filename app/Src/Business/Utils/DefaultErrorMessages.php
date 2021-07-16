<?php


namespace App\Src\Business\Utils;


class DefaultErrorMessages
{
    public const VALIDATION_FAILURE = "Inform the data correctly";
    public const DATABASE_CONNECTION_ERROR = "Database Connection Error";
    public const DATABASE_QUERY_ERROR = "Database Query Error";
    public const INTERNAL_SERVER_ERROR = "Internal Server Error";
    public const FIELD_MUST_BE_INTEGER = "This field must to be an integer.";
    public const REQUIRED_FIELD = "This field is required.";
    public const NOT_EMPTY_FIELD = "This field can not be empty.";
    public const INVALID_DATE = "This field must to be a valid date.";
    public const INVALID_DATETIME = "This field must to be a valid datetime.";
    public const MIN_CHARACTERS = "This text did not satisfied the minimum length.";
    public const MAX_CHARACTERS = "This text did not satisfied the maximum length.";
    public const INVALID_EMAIL = "This input must to be a valid email.";
}
