<?php
class Event implements JsonSerializable
{
    private int $id;
    private string $title;
    private int $unixStart;
    private int $unixEnd;
    private string $description;
    private string $picture;
    private int $categoryId;

    public function __construct(int $id, string $title, int $start, int $end, string $description, string $picture, int $categoryId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->unixStart = $start;
        $this->unixEnd = $end;
        $this->description = $description;
        $this->picture = $picture;
        $this->categoryId = $categoryId;
    }

    public function jsonSerialize(): mixed
    {
        $serialized =
            [
                'id' => $this->id,
                'title' => $this->title,
                'start' => date('d-m-Y', $this->unixStart),
                'end' => date('d-m-Y', $this->unixEnd),
                'description' => $this->description,
                'picture' => $this->picture,
                'categoryId' => $this->categoryId
            ];
        error_log($serialized['start']);

        return $serialized;
    }

    public function getStart(): int
    {
        return $this->unixStart;
    }

    public function getEnd(): int
    {
        return $this->unixEnd;
    }
}
