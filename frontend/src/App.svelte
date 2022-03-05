<script lang="ts">
import Footer from "./components/Footer.svelte";
import Header from "./components/Header.svelte";

	export let name: string;
</script>

<Header />

<main>
	<h1 class="font-bold">Hello {name}!</h1>
	<p>Visit the <a href="https://svelte.dev/tutorial">Svelte tutorial</a> to learn how to build Svelte apps.</p>
</main>

<Footer />	

<style global lang="postcss">
	@tailwind base;
	@tailwind components;
	@tailwind utilities;
</style>
