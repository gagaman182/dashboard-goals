<template>
  <div>
    <nav
      class="navbar navbar-light justify-content-start toolbargbmain textheadmain"
    >
      <img src="~/assets/logo/logo.png" class="img-fluid rounded-circle" />
      &nbsp;&nbsp;
      <h1 class="">Dashboard โรงพยาบาลหาดใหญ่</h1>
    </nav>
    <Nuxt />
  </div>
</template>

<style>
html {
  font-family: 'Kanit', sans-serif;
  font-family: 'Roboto Mono', monospace;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}
body {
  font-family: 'Pridi', serif;
}
.textheadmain {
  color: #4a47a3;
}
.toolbargbmain {
  background-color: #e7e6e1;
}

*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}

/* .button--green {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #3b8070;
  color: #3b8070;
  text-decoration: none;
  padding: 10px 30px;
}

.button--green:hover {
  color: #fff;
  background-color: #3b8070;
}

.button--grey {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #35495e;
  color: #35495e;
  text-decoration: none;
  padding: 10px 30px;
  margin-left: 15px;
}

.button--grey:hover {
  color: #fff;
  background-color: #35495e;
} */
</style>
