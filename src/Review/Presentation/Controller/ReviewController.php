<?php

declare(strict_types=1);

namespace App\Review\Presentation\Controller;

use App\Review\Application\Request\GetUserReviewsRequest;
use App\Review\Application\Request\ReviewRequest;
use App\Review\Application\UseCase\ReviewUseCaseInteractor;
use App\Review\Presentation\Resource\ReviewListResource;
use App\Review\Presentation\Resource\ReviewResource;
use App\Review\Presentation\Resource\ReviewWasDeletedResource;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Attribute\RequestQuery;
use App\Shared\Application\Response\ResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class ReviewController extends AbstractController
{
    public function __construct(private ReviewUseCaseInteractor $useCaseInteractor)
    {
    }

    #[Route('/quests/{questId}/review', methods: 'POST')]
    public function addReview(#[RequestBody] ReviewRequest $request, string $questId): Response
    {
        return ResponseFactory::createSuccessResponse(
            new ReviewResource(
                $this->useCaseInteractor->addReview($request, $questId)
            )
        );
    }

    #[Route('/user/me/reviews', methods: 'GET')]
    public function getUserReviews(#[RequestQuery] GetUserReviewsRequest $request): Response
    {
        return ResponseFactory::createSuccessResponse(
            new ReviewListResource(
                $this->useCaseInteractor->getUserReviews($request)
            )
        );
    }

    #[Route('/user/me/reviews/{reviewId}', methods: 'POST')]
    public function editReview(#[RequestBody] ReviewRequest $request, string $reviewId): Response
    {
        return ResponseFactory::createSuccessResponse(
            new ReviewResource(
                $this->useCaseInteractor->editReview($request, $reviewId)
            )
        );
    }

    #[Route('/user/me/reviews/{reviewId}', methods: 'DELETE')]
    public function deleteReview(string $reviewId): Response
    {
        return ResponseFactory::createSuccessResponse(
            new ReviewWasDeletedResource(
                $this->useCaseInteractor->deleteReview($reviewId)
            )
        );
    }
}
