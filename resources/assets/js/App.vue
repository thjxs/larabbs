<template>
    <div id="app">
        <nav-menu/>
        <div class="container">
            <router-view/>
        </div>
        <footer-view/>
    </div>
</template>

<script>
import NavMenu from './components/nav';
import FooterView from './components/footer';
export default {
    name: 'App',
    components: {
        NavMenu,
        FooterView
    }
}
</script>
