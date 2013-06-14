# BoostCake

CakePHP(2.3.x) Plugin for [Bootstrap(3.0.0-wip)](https://github.com/twitter/bootstrap/tree/3.0.0-wip)

## Development Policy

* More Simple! Simple! Simple!
* Make only those that FormHelper in $options unable to solve.

### What is unable to solve

#### Label

	// CakePHP Format
	<input type="radio" name="data[Foo][bar]" />
	<label for="data[Foo][bar]">Foo</label>

	// Bootstrap Format
	<label for="data[Foo][bar]">
		<input type="radio" name="data[Foo][bar]">
		Foo
	</label>


#### Error Class

	// Bootstrap Format
	<div class="control-group has-error">
		<label class="control-label" for="inputError">Input with error</label>
		<div class="controls">
			<input type="text" class="input-with-feedback" id="inputError">
		</div>
	</div>

