<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <router-link :to="{ name: 'home' }" class="navbar-brand">Testing</router-link>
    <router-link :to="{ name: 'home' }" class="nav-link">Home</router-link>
    <router-link :to="{ name: 'login' }" class="nav-link">Login</router-link>
  </nav>
</template>