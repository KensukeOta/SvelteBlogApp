<script lang="ts">
import { Router, Route } from "svelte-routing";
import Home from "./pages/Home.svelte";
import LoginForm from "./pages/LoginForm.svelte";
import RegisterForm from "./pages/RegisterForm.svelte";

	export let url: string = "";
</script>

<Router url={url}>
	<Route path="/signup" component="{RegisterForm}" />
	<Route path="/login" component="{LoginForm}" />
	<Route path="/"><Home /></Route>
</Router>

<style global lang="postcss">
	@tailwind base;
	@tailwind components;
	@tailwind utilities;
</style>
