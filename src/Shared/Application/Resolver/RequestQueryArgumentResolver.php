<?php

namespace App\Shared\Application\Resolver;

use App\Shared\Application\Attribute\RequestQuery;
use App\Shared\Application\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class RequestQueryArgumentResolver implements ValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (!$argument->getAttributesOfType(RequestQuery::class, ArgumentMetadata::IS_INSTANCEOF)) {
            return [];
        }

        try {
            $strQuery = [];
            $arrQuery = [];

            foreach ($request->query->all() as $key => $value) {
                if (!is_array($value)) {
                    $strQuery[$key] = $value;
                    continue;
                }

                $arrQuery[$key] = $value;
            }

            $query = array_map(
                static function (string $value) {
                    $int_value = ctype_digit($value) ? (int) $value : null;

                    return $int_value ?? $value;
                }, $strQuery);

            $query = array_merge($query, $arrQuery);

            $model = $this->serializer->deserialize(
                json_encode($query, JSON_THROW_ON_ERROR),
                $argument->getType(),
                JsonEncoder::FORMAT
            );
        } catch (\Throwable $throwable) {
            throw new ValidationException('Validation error');
        }

        $errors = $this->validator->validate($model);
        if (count($errors) > 0) {
            throw new ValidationException(json_encode($this->getViolations($errors)));
        }

        return [$model];
    }

    private function getViolations(ConstraintViolationListInterface $errors): array
    {
        $result = [];
        for ($i = 0; $i < $errors->count(); ++$i) {
            $error = $errors->get($i);
            $result[$error->getPropertyPath()] = $error->getMessage();
        }

        return $result;
    }
}
