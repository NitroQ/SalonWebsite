@extends('template.main')

@section('main-content')

<style>
.row {
    display: flex;
    flex-wrap: wrap;
    padding: 0 4px;
  }
  
  /* Create four equal columns that sits next to each other */
  .column {
    flex: 25%;
    max-width: 25%;
    padding: 0 4px;
  }
  
  .column img {
    margin-top: 8px;
    vertical-align: middle;
    width: 100%;
  }
  
  /* Responsive layout - makes a two column-layout instead of four columns */
  @media screen and (max-width: 800px) {
    .column {
      flex: 50%;
      max-width: 50%;
    }
  }
  
  /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
  @media screen and (max-width: 600px) {
    .column {
      flex: 100%;
      max-width: 100%;
    }
  }

</style>
 
<div class="container py-5 ">
    <h1 class="font-weight-bold"><b>Gallery</b></h1>

    <div class="row">
        <div class="column">
          <img src="/images/gallery/a1.jpg">
          <img src="/images/gallery/a2.jpg">
          <img src="/images/gallery/a3.jpg">
          <img src="/images/gallery/a4.jpg">
          <img src="/images/gallery/a5.jpg">
          <img src="/images/gallery/a6.jpg">
          <img src="/images/gallery/a7.jpg">
        </div>
        <div class="column">
          <img src="/images/gallery/a8.jpg">
          <img src="/images/gallery/a9.jpg">
          <img src="/images/gallery/a10.jpg">
          <img src="/images/gallery/a11.jpg">
          <img src="/images/gallery/a12.jpg">
          <img src="/images/gallery/a13.jpg">
        </div>
        <div class="column">
          <img src="/images/gallery/a14.jpg">
          <img src="/images/gallery/a15.jpg">
          <img src="/images/gallery/a16.jpg">
          <img src="/images/gallery/a17.jpg">
          <img src="/images/gallery/a18.jpg">
          <img src="/images/gallery/a19.jpg">
          <img src="/images/gallery/a20.jpg">
        </div>
        <div class="column">
          <img src="/images/gallery/a21.jpg">
          <img src="/images/gallery/a22.jpg">
          <img src="/images/gallery/a23.jpg">
          <img src="/images/gallery/a24.jpg">
          <img src="/images/gallery/a25.jpg">
          <img src="/images/gallery/a26.jpg">
        </div>
      </div>
</div>
@endsection