<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use League\CommonMark\Normalizer\SlugNormalizer;
use App\Models\Series;

class CreateSeriesRequest extends FormRequest
{

    public $fileName;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ];
    }

    public function uploadSeriesImage() {
        $sluger = new SlugNormalizer;
        // upload file
        $uploadedImage = $this->image;
        $this->fileName = $sluger->normalize($this->title). '.' .$uploadedImage->getClientOriginalExtension();
        $uploadedImage->storePubliclyAs('series',$this->fileName);

        return $this;
    }

    public function storeSeries() {
        $sluger = new SlugNormalizer;
        // create series
        $series = Series::create([
            'title' => $this->title,
            'slug' => $sluger->normalize($this->title),
            'description' => $this->description,
            'image_url' => 'series/'.$this->fileName
        ]);

        
        session()->flash('success', 'Series created successfully.');
        // redirect user to a page to see all series
        return redirect()->route('series.show',$series->slug);
    }
}
