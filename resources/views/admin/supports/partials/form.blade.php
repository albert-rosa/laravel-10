@csrf
<input type="text" placeholder="Assunto" name="subject" value="{{ old('subject') ?? $support->subject ?? old('subject')}}">
<textarea name="body" id="" cols="30" rows="5" placeholder="descrição">{{ old('body') ?? $support->body ?? old('body')}}</textarea>
<button type="submit">Enviar</button>