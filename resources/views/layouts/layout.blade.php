<!DOCTYPE html>
<html lang="en">

@include("fixed.head")

<body>

    @include("fixed.loader")

    @include("fixed.navigation")

    @yield("content")

    @include("fixed.footer")

    @include("fixed.scripts")

    @yield("additionalScripts")

</body>

</html>
