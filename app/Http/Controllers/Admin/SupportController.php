<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    )
    {}

    public function index(Request $request){

        //$support = new Support(); essa linha é equivalente ao argumento dessa função.
        //$supports = $support->all();        
        //dd($supports); debuging function
        
        $supports = $this->service->paginate(
            page: $request->get('page',1),
            totalPerPage: $request->get('total_per_page',2),
            filter: $request->filter
        );
        $filters = ($request->filter) ? ['filter'=> $request->get('filter', '')]: null;
        //dd($filters);
        return view('admin/supports/index', compact('supports', 'filters'));
    }

    public function show(string $id){
        
        //$support = Support::find($id);
        //$support = Support::where('id',$id)->first();
        //$support = Support::where('id','=', $id)->first();
        $support = $this->service->findOne($id);
        //dd($support);
        if($support != null)
            return view('admin/supports/show', compact('support'));
        return redirect()->back();

        /* FORMA ALTERNATIVA
        if(!$support)
            return redirect()->back();
        return view('admin/supports/show');
        */
    }

    public function create(){
        return view('admin/supports/create');
    }

    public function edit(string $id){
        //$support = Support::find($id);
        $support = $this->service->findOne($id);
        if(!$support)
            return redirect()->back();
        return view('admin/supports/edit', compact('support'));
    }

    public function store(StoreUpdateSupport $request){
        //dd($request->all());
        //$data = $request->only(['subject','body']);
        //$data['status'] = 'a';
        //Support::create($data); Se não declarar a instancia do model Support nos argumentos da função, usa-se a chamada do método de forma estatica
        //$support->create($data);
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );
        return redirect()->route('supports.index');
    }

    public function update(int $id, StoreUpdateSupport $request){
        //dd($request->id);
        //$support = Support::find($id);
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request,$id)
        );

        //$support->subject = $request->subject;
        //$support->body = $request->body;
        //$support->save();
        if (!$support)
            return redirect()->back();

        //$data = $request->only(['subject','body']);
        //$data = $request->validated(); 
        // $support->update($data);
        
        return redirect()->route('supports.index');             
    }

    public function destroy(string $id){

        // $support = Support::find($id);       
        // if (!$support)
        //     return redirect()->back();  
        // $support->delete();
        $this->service->delete($id);
        return redirect()->route('supports.index'); 
    }
}
