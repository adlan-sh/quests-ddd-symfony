<?php

namespace App\Shared\Application\Resolver;

use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Exception\RequestBodyConvertException;
use App\Shared\Application\Exception\ValidationException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class RequestBodyArgumentResolver implements ValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (!$argument->getAttributesOfType(RequestBody::class, ArgumentMetadata::IS_INSTANCEOF)) {
            return [];
        }

        try {
            if (JsonEncoder::FORMAT === $request->getContentTypeFormat()) {
                $model = $this->serializer->deserialize(
                    $request->getContent(),
                    $argument->getType() ?? 'object',
                    JsonEncoder::FORMAT,
                );
            }

            if ('form' === $request->getContentTypeFormat()) {
                $model = null;

                foreach ($request->request as $key => $value) {
                    $model[$key] = $value;
                }

                /**
                 * @var string       $key
                 * @var UploadedFile $value
                 */
                foreach ($request->files as $key => $value) {
                    if (null !== $value) {
                        move_uploaded_file(
                            $value->getPathname(),
                            $_ENV['IMG_PATH'].$value->getClientOriginalName()
                        );
                        $model[$key] = [
                            'name' => $value->getClientOriginalName(),
                            'url' => $_ENV['IMG_PATH'].$value->getClientOriginalName(),
                        ];
                    }
                }

                $model = $this->serializer->deserialize(
                    json_encode($model),
                    $argument->getType(),
                    JsonEncoder::FORMAT
                );
            }
        } catch (\Throwable $throwable) {
            throw new RequestBodyConvertException($throwable->getMessage());
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
