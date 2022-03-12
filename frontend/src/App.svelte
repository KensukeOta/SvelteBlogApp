<script lang="ts">
	import { Router, Route } from "svelte-routing";
	import Home from "./pages/Home.svelte";
	import LoginForm from "./pages/LoginForm.svelte";
	import PostForm from "./pages/PostForm.svelte";
	import RegisterForm from "./pages/RegisterForm.svelte";

	export let url: string = "";
</script>

<Router url={url}>
	<Route path="/signup" component="{RegisterForm}" />
	<Route path="/login" component="{LoginForm}" />
	<Route path="/posts/create" component="{PostForm}" />
	<Route path="/"><Home /></Route>
</Router>

<style global lang="postcss">
	@tailwind base;
	@tailwind components;
	@tailwind utilities;
</style>
