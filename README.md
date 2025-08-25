# Documentação de Components Blade

## Componentes Anônimos

Componentes anônimos são criados apenas com um arquivo Blade, sem classe PHP. São ideais para trechos de interface reutilizáveis e simples.

Exemplo de uso:

```php
<x-alert>
	Olá, Esse é um component anônimo!
</x-alert>
```

Arquivo do componente:

```php
<!-- resources/views/components/alert.blade.php -->
<div class="alert alert-warning">
	{{ $slot }}
</div>
```

---

## Slots e Multi-Slots

Slots permitem passar conteúdo para dentro de componentes. Multi-slots (slots nomeados) permitem múltiplas áreas de conteúdo.

Slot simples:

```php
<x-other>
	<h1>INSERIDO COM SLOT</h1>
</x-other>
```

Multi-slot:

```php
<x-multi_slot>
	<x-slot:title>
		Título
	</x-slot:title>
	<x-slot:content>
		Conteúdo principal
	</x-slot:content>
	<x-slot:footer>
		Rodapé
	</x-slot:footer>
</x-multi_slot>
```

---

## Layout Components

Layout components são usados para estruturar o layout base das páginas, permitindo reutilizar cabeçalho, rodapé e áreas dinâmicas.

Exemplo de uso:

```php
<x-layout_component>
	<x-slot:title>
		Título da Página
	</x-slot:title>
	<x-slot:content>
		<h1>Conteúdo da Página</h1>
	</x-slot:content>
</x-layout_component>
```

Estrutura do componente:

```php
<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
</head>
<body>
	<header>
		<!-- Cabeçalho -->
	</header>
	<main>
		{{ $content }}
	</main>
	<footer>
		<!-- Rodapé -->
	</footer>
</body>
</html>
```
