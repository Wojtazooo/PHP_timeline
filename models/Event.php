<?php
class Event
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

    public function getStart(): int
    {
        return $this->unixStart;
    }

    public function getStartFormatted($format = 'd-m-Y'): string
    {
        return date($format, $this->unixStart);
    }

    public function getEnd(): int
    {
        return $this->unixEnd;
    }

    public function getEndFormatted($format = 'd-m-Y'): string
    {
        return date($format, $this->unixEnd);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
