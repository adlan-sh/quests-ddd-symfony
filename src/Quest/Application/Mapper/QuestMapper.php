<?php

declare(strict_types=1);

namespace App\Quest\Application\Mapper;

use App\Quest\Application\Model\GenreDTO;
use App\Quest\Application\Model\QuestDTO;
use App\Quest\Application\Model\QuestListItemDTO;
use App\Quest\Application\Model\TagDTO;
use App\Quest\Application\Model\ThemeDTO;
use App\Quest\Domain\Aggregation\Quest;
use App\Quest\Domain\Entity\Genre;
use App\Quest\Domain\Entity\Tag;
use App\Quest\Domain\Entity\Theme;
use App\Shared\Application\Mapper\FileMapper;
use App\Shared\Application\Model\PaginationDTO;
use App\Shared\Domain\Entity\File;

class QuestMapper
{
    public static function toQuestDTO(Quest $quest): QuestDTO
    {
        return (new QuestDTO())
            ->setId($quest->getId())
            ->setName($quest->getName())
            ->setDescription($quest->getDescription())
            ->setCode($quest->getCode())
            ->setSeatsCount($quest->getSeatsCount())
            ->setGenre(self::mapToGenreDTO($quest->getGenre()))
            ->setDateEvent($quest->getDateEvent())
            ->setDateFinalAppointment($quest->getDateFinalAppointment())
            ->setThemes(array_map(static function (Theme|array $theme) {
                return self::mapToThemeDTO($theme);
            }, $quest->getThemes()))
            ->setTags(array_map(static function (Tag|array $tag) {
                return self::mapToTagDTO($tag);
            }, $quest->getTags()))
            ->setGallery(array_map(static function (File|array $file) {
                return FileMapper::toFileDTO($file);
            }, $quest->getGallery()));
    }

    public static function toPaginationDTO(array $pagination): PaginationDTO
    {
        return new PaginationDTO(
            $pagination['currentPage'],
            $pagination['totalCount'],
            $pagination['pageSize'],
        );
    }

    public static function toQuestListDTO(array $questList): array
    {
        return array_map(
            static function (Quest $quest) {
                return (new QuestListItemDTO())
                    ->setId($quest->getId())
                    ->setName($quest->getName())
                    ->setDescription($quest->getDescription())
                    ->setCode($quest->getCode())
                    ->setDetailLink($quest->getCode())
                    ->setSeatsCount($quest->getSeatsCount())
                    ->setGenre(self::mapToGenreDTO($quest->getGenre()))
                    ->setDateEvent($quest->getDateEvent())
                    ->setThemes(array_map(static function (Theme $theme) {
                        return self::mapToThemeDTO($theme);
                    }, $quest->getThemes()))
                    ->setTags(array_map(static function (Tag $tag) {
                        return self::mapToTagDTO($tag);
                    }, $quest->getTags()))
                    ->setGallery(array_map(static function (File $file) {
                        return FileMapper::toFileDTO($file);
                    }, $quest->getGallery()));
            }, $questList);
    }

    public static function mapToGenreDTO(?Genre $genre): GenreDTO
    {
        return new GenreDTO(
            $genre?->getId(),
            $genre?->getName(),
            $genre?->getCode()
        );
    }

    public static function mapToThemeDTO(Theme|array $theme): ThemeDTO
    {
        if ($theme instanceof Theme) {
            return new ThemeDTO(
                $theme->getId(),
                $theme->getName(),
                $theme->getCode()
            );
        }

        return new ThemeDTO(
            $theme['id'],
            $theme['name'],
            $theme['code']
        );
    }

    public static function mapToTagDTO(Tag|array $tag): TagDTO
    {
        if ($tag instanceof Tag) {
            return new TagDTO(
                $tag->getId(),
                $tag->getName(),
            );
        }

        return new TagDTO(
            $tag['id'],
            $tag['name'],
        );
    }
}
